# Plataforma Ciencias Humanas — Fase 1

Proyecto base de Laravel 11 + PostgreSQL + Livewire + Alpine.js + Tailwind CSS.

Este repositorio contiene **todo el código fuente ya escrito** para la Fase 1 (autenticación, roles, layout, sistema visual y panel administrativo esqueleto). Como es normal en cualquier proyecto Laravel, necesitas instalar las dependencias (`vendor/`, `node_modules/`) en tu máquina antes de correrlo — eso no viene incluido en el código, se genera localmente.

---

## 1. Requisitos previos

- PHP >= 8.2 con extensiones: `pdo_pgsql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`
- Composer 2.x
- Node.js >= 18 y npm
- PostgreSQL >= 14 corriendo localmente (o accesible por red)
- Git

## 2. Instalación paso a paso

```bash
# 1. Entra a la carpeta del proyecto (ya descomprimida)
cd plataforma-ciencias-humanas

# 2. Instala las dependencias de PHP
composer install

# 3. Copia el archivo de entorno y genera la clave de la app
cp .env.example .env
php artisan key:generate

# 4. Edita .env con los datos de tu PostgreSQL local, por ejemplo:
#    DB_DATABASE=ciencias_humanas
#    DB_USERNAME=postgres
#    DB_PASSWORD=tu_password

# 5. Crea la base de datos en PostgreSQL (una sola vez)
#    Desde psql o pgAdmin:
#    CREATE DATABASE ciencias_humanas;

# 6. Instala Laravel Breeze con el stack de Livewire (autenticacion)
composer require laravel/breeze --dev
php artisan breeze:install livewire
#    Cuando pregunte por Pest/PHPUnit y Dark mode, elige segun prefieras.

# 7. Instala las dependencias de Node y compila los assets
npm install
npm run build
#    (para desarrollo con recarga automatica usa: npm run dev)

# 8. Corre las migraciones y los seeders (roles, admin, categorias)
php artisan migrate --seed

# 9. Enlaza el storage publico (para imagenes/archivos subidos)
php artisan storage:link

# 10. Levanta el servidor de desarrollo
php artisan serve
```

Abre **http://localhost:8000** — deberías ver el portal público con el menú
ARTÍCULOS | LIBROS | REVISTAS | SITIOS WEB | CURSOS | DIPLOMADOS | TALLERES.

## 3. Usuario administrador de prueba

El seeder `AdminUserSeeder` crea automáticamente:

```
Correo:    admin@ciencias-humanas.local
Password:  CambiarEstaClave123!
```

**Importante:** cambia esta contraseña antes de usar el proyecto fuera de un entorno local de desarrollo.

Inicia sesión en `/login` y luego entra a `/admin` para ver el panel administrativo.

## 4. Un paso manual pendiente: registrar el middleware de roles

Laravel 11 centraliza el registro de middleware en `bootstrap/app.php` (este archivo lo genera `laravel new`, no viene en este paquete de código ya que es parte del esqueleto oficial de Laravel que instala Composer). Ábrelo y agrega:

```php
use App\Http\Middleware\EnsureUserHasRole;

->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => EnsureUserHasRole::class,
    ]);
})
```

Esto habilita `->middleware('role:administrador')`, usado en `routes/admin.php`.

## 5. Estructura relevante de este entregable

```
app/Models/                  Modelos Eloquent (User, Course, Diploma, Workshop, etc.)
app/Models/Concerns/         Traits reutilizables (HasPublicationLifecycle, HasEducationalOffering)
app/Livewire/Admin/          Componentes del panel administrativo (esqueleto navegable)
app/Livewire/Dashboard/      (vistas Blade en resources/views/livewire/dashboard)
app/Http/Controllers/Public/ Controladores del portal público
app/Policies/                Policy de ejemplo (CoursePolicy) — patrón a replicar en Fase 2-4
database/migrations/         Todas las tablas del modelo de datos acordado
database/seeders/            Roles, permisos, usuario admin, categorías base
resources/views/layouts/     Sistema de diseño único (azul + amarillo), público y privado
resources/views/public/      Vistas del portal público (home + 7 secciones del menú)
resources/views/livewire/    Vistas de los componentes Livewire del panel admin
routes/web.php               Rutas públicas + dashboard privado
routes/admin.php             Rutas del panel administrativo (protegidas por rol)
config/permission.php        Configuración de spatie/laravel-permission (referencia)
```

## 6. Qué SÍ incluye esta Fase 1

- Base de datos completa según el modelo acordado (PostgreSQL).
- Autenticación (vía Breeze + Livewire, se instala en el paso 6).
- Roles y permisos (administrador, docente, investigador, alumno) con `spatie/laravel-permission`.
- Layout y sistema de diseño único (azul principal + amarillo de acento), reutilizado en portal público y panel privado.
- Panel administrativo navegable con listados de lectura (sin formularios de alta/edición todavía) para: usuarios, categorías, artículos, libros, revistas, sitios web, cursos, diplomados, talleres, y una pantalla de métricas básicas.
- Portal público completo en sus 7 secciones (listados y fichas), incluyendo el botón "INGRESAR AL CURSO" que lee el enlace de `moodle_course_links`.
- Dashboards privados diferenciados por rol (alumno, docente, investigador).

## 7. Qué queda fuera de esta fase (según el plan)

- CRUD completo (crear/editar/eliminar) de cada módulo — se construye en Fases 2 a 4.
- Contenido real publicado — hoy la base de datos está vacía salvo roles/categorías semilla.
- Instalación e integración real de Moodle — Fase 6.
- Búsqueda avanzada y filtros del repositorio — Fase 3.
- Pruebas automatizadas, despliegue a producción, dominio y SSL — Fases 7 y 8.
