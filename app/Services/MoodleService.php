<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Integración mínima con Moodle por servicios web REST.
 *
 * Requiere en Moodle:
 *  - Servicios web habilitados y protocolo REST habilitado.
 *  - Un servicio externo con core_course_create_courses y core_course_get_courses.
 *  - Un token para el usuario admin, guardado en MOODLE_API_TOKEN.
 *
 * Si falta base_url o token, createCourse() devuelve ['ok' => false]
 * con un error legible, sin lanzar excepciones, para que el curso de
 * Laravel se guarde igual y el usuario pueda pegar la URL a mano.
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
}
