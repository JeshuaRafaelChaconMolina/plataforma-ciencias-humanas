<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Integración mínima con Moodle por servicios web REST.
 *
 * Requiere en Moodle:
 *  - Servicios web habilitados y protocolo REST habilitado.
 *  - Un servicio externo con core_course_create_courses,
 *    core_course_get_courses, core_course_update_courses y, para el
 *    registro de alumnos, core_user_create_users y
 *    core_user_get_users_by_field.
 *  - Un token para el usuario admin, guardado en MOODLE_API_TOKEN.
 *
 * Si falta base_url o token, createCourse()/createUser() devuelven
 * ['ok' => false] con un error legible, sin lanzar excepciones, para
 * que lo de Laravel se guarde igual y el usuario pueda pedir su
 * cuenta en Moodle al administrador.
 */
class MoodleService
{
    public function isConfigured(): bool
    {
        return config('moodle.base_url') !== ''
            && config('moodle.api_token') !== '';
    }

    public function courseUrl(int|string $moodleCourseId): ?string
    {
        $base = config('moodle.base_url');

        return $base !== '' ? $base.'/course/view.php?id='.$moodleCourseId : null;
    }

    /**
     * Crea el curso en Moodle.
     *
     * @return array{ok: bool, id?: int, url?: string, error?: string}
     */
    public function createCourse(string $fullname, string $shortname, string $summary = '', ?int $laravelCourseId = null): array
    {
        $base = config('moodle.base_url');
        $token = config('moodle.api_token');

        if ($base === '' || $token === '') {
            return [
                'ok' => false,
                'error' => 'Moodle no está configurado: falta MOODLE_BASE_URL o MOODLE_API_TOKEN en el .env.',
            ];
        }

        // shortname debe ser único en Moodle; se sufija con el id de Laravel si se conoce.
        $shortname = Str::slug($shortname !== '' ? $shortname : $fullname, '-');
        $shortname = Str::limit($shortname, 80, '');
        if ($laravelCourseId !== null) {
            $shortname .= '-'.$laravelCourseId;
        }
        if ($shortname === '') {
            $shortname = 'curso-'.($laravelCourseId ?? time());
        }

        try {
            $response = Http::timeout(30)->asForm()->post($base.'/webservice/rest/server.php', [
                'wstoken' => $token,
                'wsfunction' => 'core_course_create_courses',
                'moodlewsrestformat' => 'json',
                'courses' => [
                    [
                        'fullname' => $fullname,
                        'shortname' => $shortname,
                        'categoryid' => (int) config('moodle.category_id', 1),
                        'summary' => $summary,
                        'visible' => 1,
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return ['ok' => false, 'error' => 'No se pudo conectar con Moodle: '.$e->getMessage()];
        }

        if (! $response->successful()) {
            return ['ok' => false, 'error' => 'Moodle respondió HTTP '.$response->status().'. Revisa la URL y el token.'];
        }

        $data = $response->json();

        if (is_array($data) && isset($data['exception'])) {
            return ['ok' => false, 'error' => 'Moodle: '.($data['message'] ?? $data['exception'])];
        }

        $created = is_array($data) ? ($data[0] ?? null) : null;

        if (! is_array($created) || empty($created['id'])) {
            return ['ok' => false, 'error' => 'Moodle no devolvió el id del curso creado. Respuesta: '.json_encode($data)];
        }

        $id = (int) $created['id'];

        return ['ok' => true, 'id' => $id, 'url' => $this->courseUrl($id)];
    }

    /**
     * Nombre de usuario de Moodle a partir del correo.
     *
     * Moodle usa el nombre de usuario (no el correo) para iniciar sesión,
     * así que se deriva de la parte local del correo: solo minúsculas,
     * números y guion bajo, como máximo 25 caracteres para dejar sitio
     * al sufijo _2, _3... si el nombre ya existe.
     */
    public function usernameFromEmail(string $email): string
    {
        $local = Str::lower(Str::before($email, '@'));
        $local = str_replace(['.', '-'], '_', $local);
        $username = (string) preg_replace('/[^a-z0-9_]/', '', $local);
        $username = trim($username, '_');
        $username = Str::limit($username, 25, '');

        return $username !== '' ? $username : 'alumno';
    }

    /**
     * Busca un usuario de Moodle por correo.
     *
     * @return array{id: int, username: string}|null null si no existe o si Moodle no responde.
     */
    public function findUserByEmail(string $email): ?array
    {
        $base = config('moodle.base_url');
        $token = config('moodle.api_token');

        if ($base === '' || $token === '') {
            return null;
        }

        try {
            $response = Http::timeout(30)->asForm()->post($base.'/webservice/rest/server.php', [
                'wstoken' => $token,
                'wsfunction' => 'core_user_get_users_by_field',
                'moodlewsrestformat' => 'json',
                'field' => 'email',
                'values' => [$email],
            ]);
        } catch (\Throwable $e) {
            return null;
        }

        if (! $response->successful()) {
            return null;
        }

        $data = $response->json();

        if (! is_array($data) || isset($data['exception'])) {
            return null;
        }

        $found = $data[0] ?? null;

        if (! is_array($found) || empty($found['id']) || empty($found['username'])) {
            return null;
        }

        return ['id' => (int) $found['id'], 'username' => (string) $found['username']];
    }

    /**
     * Crea un usuario en Moodle con la misma contraseña de Laravel.
     *
     * La contraseña llega en texto plano solo en el momento del registro
     * (el registro la tiene antes de hashearla). No se guarda, no se
     * registra en logs y no se devuelve en la respuesta.
     *
     * Si el correo ya existe en Moodle, no crea un duplicado: devuelve
     * el usuario existente para enlazarlo. Si el nombre de usuario ya
     * existe, reintenta con _2, _3... hasta 5 veces.
     *
     * @return array{ok: bool, id?: int, username?: string, already_existed?: bool, error?: string}
     */
    public function createUser(string $name, string $email, string $plainPassword): array
    {
        $base = config('moodle.base_url');
        $token = config('moodle.api_token');

        if ($base === '' || $token === '') {
            return [
                'ok' => false,
                'error' => 'Moodle no está configurado: falta MOODLE_BASE_URL o MOODLE_API_TOKEN en el .env.',
            ];
        }

        // No duplicar: si el correo ya tiene cuenta en Moodle, se enlaza esa.
        $existing = $this->findUserByEmail($email);

        if ($existing !== null) {
            return ['ok' => true, 'id' => $existing['id'], 'username' => $existing['username'], 'already_existed' => true];
        }

        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $firstname = $parts[0] ?? $email;
        $lastname = count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : $firstname;

        $username = $this->usernameFromEmail($email);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $tryUsername = $attempt === 0 ? $username : $username.'_'.($attempt + 1);

            try {
                $response = Http::timeout(30)->asForm()->post($base.'/webservice/rest/server.php', [
                    'wstoken' => $token,
                    'wsfunction' => 'core_user_create_users',
                    'moodlewsrestformat' => 'json',
                    'users' => [
                        [
                            'username' => $tryUsername,
                            'password' => $plainPassword,
                            'firstname' => $firstname,
                            'lastname' => $lastname,
                            'email' => $email,
                            'auth' => 'manual',
                            'lang' => 'es',
                        ],
                    ],
                ]);
            } catch (\Throwable $e) {
                return ['ok' => false, 'error' => 'No se pudo conectar con Moodle: '.$e->getMessage()];
            }

            if (! $response->successful()) {
                return ['ok' => false, 'error' => 'Moodle respondió HTTP '.$response->status().'. Revisa la URL y el token.'];
            }

            $data = $response->json();

            if (is_array($data) && isset($data['exception'])) {
                $message = (string) ($data['message'] ?? $data['exception']);

                // El nombre de usuario ya existe: reintentar con sufijo.
                if (stripos($message, 'already exists') !== false || stripos($message, 'ya existe') !== false) {
                    continue;
                }

                return ['ok' => false, 'error' => 'Moodle: '.$message];
            }

            $created = is_array($data) ? ($data[0] ?? null) : null;

            if (! is_array($created) || empty($created['id'])) {
                return ['ok' => false, 'error' => 'Moodle no devolvió el id del usuario creado. Respuesta: '.json_encode($data)];
            }

            return ['ok' => true, 'id' => (int) $created['id'], 'username' => $tryUsername];
        }

        return ['ok' => false, 'error' => 'No se pudo crear el usuario en Moodle: el nombre de usuario derivado del correo ya existe y no se pudo generar uno único.'];
    }
}
