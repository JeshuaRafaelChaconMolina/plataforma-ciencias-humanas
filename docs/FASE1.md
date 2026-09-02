# FASE 1 — Entrega

## Qué se hizo

- Proyecto base Laravel 11 con PostgreSQL como motor de base de datos.
- Modelo de datos completo: núcleo (usuarios, roles, permisos, categorías, archivos, auditoría) y las 7 entidades de contenido (articles, books, journals, websites, courses + course_modules + moodle_course_links, diplomas + diploma_courses, workshops) como **tablas independientes**, con reutilización de lógica vía dos traits Eloquent (`HasPublicationLifecycle`, `HasEducationalOffering`) en lugar de una tabla genérica.
- Roles y permisos con `spatie/laravel-permission`: administrador, docente, investigador, alumno — con permisos granulares por módulo y acción (ver/crear/editar/eliminar).
- Autenticación vía Laravel Breeze + stack Livewire (se instala en el paso 6 del README, ya que es scaffolding oficial de Laravel).
- Sistema de diseño único (Tailwind, azul + amarillo institucional) aplicado en `layouts/public.blade.php` (portal) y `layouts/app.blade.php` (panel privado/admin), con Alpine.js para interactividad ligera (menú móvil).
- Panel administrativo navegable (Livewire) con sidebar condicionado por permisos y listados de solo lectura para los 9 módulos de gestión.
- Portal público completo en sus 7 secciones del menú oficial (listado + ficha), incluyendo el botón "INGRESAR AL CURSO" que lee `moodle_course_links`.
- Dashboards privados diferenciados por rol (alumno, docente, investigador).
- Middleware `role:` para proteger rutas, y una Policy de ejemplo (`CoursePolicy`) como patrón a replicar en las fases siguientes.

## Árbol de archivos

Ver `README.md` sección 5, o el árbol completo entregado en el .zip del proyecto.

## Migraciones / seeders

17 migraciones (núcleo + repositorio + oferta educativa) y 4 seeders: `RoleSeeder`, `AdminUserSeeder`, `CategorySeeder`, `DatabaseSeeder`. Ver `README.md` para el comando de ejecución (`php artisan migrate --seed`).

## Variables de entorno

Definidas en `.env.example`: conexión PostgreSQL, sesión/caché/colas por base de datos, correo por log (desarrollo), y variables reservadas para Moodle (`MOODLE_BASE_URL`, `MOODLE_SSO_ENABLED=false`) que se activarán en Fase 6.

## Instrucciones de ejecución

Ver `README.md` sección 2, paso a paso desde `composer install` hasta `php artisan serve`.

## Pruebas

En esta fase no se incluyen pruebas automatizadas (PHPUnit/Pest se configuran en Fase 7, según el plan). Se recomienda verificación manual:
1. Registrar/iniciar sesión con el usuario admin semilla.
2. Confirmar que `/admin` es accesible solo para el rol administrador.
3. Confirmar que el portal público carga sin autenticación.
4. Confirmar que un curso sin `moodle_course_links` no muestra el botón "INGRESAR AL CURSO".

## Cambios en documentación

Se actualiza este documento y el README con el alcance real construido. La arquitectura y modelo de datos de la actualización previa (`FASE0_Actualizacion_Arquitectura.md`) se mantienen sin cambios — no hubo desviaciones respecto a lo acordado.

## Pendientes

- Registrar manualmente el alias de middleware `role` en `bootstrap/app.php` (paso documentado en README, ya que ese archivo lo genera el instalador oficial de Laravel, no este entregable).
- Elegir entre Breeze/Fortify quedó resuelto a favor de Breeze (stack oficial con Livewire) — confirmar que el equipo está de acuerdo.
- CRUD completo de cada módulo (Fase 2 a 4).
- Contenido real de prueba más allá de las categorías semilla.

## Riesgos

- Si el equipo no ejecuta `composer require laravel/breeze --dev && php artisan breeze:install livewire` antes de levantar el servidor, las rutas de autenticación (`/login`, `/register`) no existirán todavía.
- La contraseña semilla del administrador (`CambiarEstaClave123!`) debe cambiarse antes de cualquier uso fuera de desarrollo local.
- No se ha validado aún contra una instancia real de PostgreSQL (este sandbox no tiene acceso a Packagist ni a un servidor Postgres), por lo que se recomienda que el equipo corra `php artisan migrate` localmente y reporte cualquier error de sintaxis SQL específico de PostgreSQL antes de continuar a Fase 2.
