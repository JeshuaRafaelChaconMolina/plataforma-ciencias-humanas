# Guía de instalación para el equipo

Esta guía explica cómo dejar el proyecto corriendo en tu propia computadora (Windows) y cómo trabajar en equipo con Git y GitHub.

Léela completa antes de empezar: incluye advertencias de errores que ya nos tocó resolver.

---

## 1. Programas que necesitas instalar (una sola vez)

| Programa | Notas importantes |
|---|---|
| **Git** | Para clonar el proyecto y sincronizar cambios |
| **PHP 8.3+** | Ver advertencias abajo |
| **Composer** | El instalador detecta PHP automáticamente |
| **Node.js 18+** | Incluye npm |
| **PostgreSQL 14+** | Anota la contraseña que le pongas al usuario `postgres` |
| **Visual Studio Code** | Editor recomendado (trae Git integrado) |

Para verificar qué tienes instalado, abre PowerShell y corre cada comando:

```
git --version
php -v
composer -V
node -v
psql --version
```

### Advertencias sobre la instalación de PHP en Windows

PHP en Windows se descarga como un `.zip` (no trae instalador), y tiene tres detalles que nos causaron problemas:

1. **`php.exe` debe quedar directo en la carpeta**, no dentro de una subcarpeta. Al extraer el zip suele crearse una subcarpeta extra (ej. `C:\php\php-8.3.x-...\php.exe`) — mueve todo el contenido un nivel arriba para que quede `C:\php\php.exe`.

2. **Agrega `C:\php` al PATH** (Variables de entorno → Path → Nuevo). Cierra y abre PowerShell después de cambiarlo.

3. **Crea el archivo `php.ini`**: PHP trae `php.ini-development`; cópialo y renombra la copia a `php.ini`.
   - ⚠️ **Activa primero "Extensiones de nombre de archivo"** en el Explorador (pestaña Vista → Mostrar), porque Windows puede guardarlo como `php.ini.ini` sin que lo notes, y PHP no lo va a cargar.
   - Verifica con `php --ini` que diga la ruta de tu `php.ini` en "Loaded Configuration File". Si dice `(none)`, crea una variable de entorno de usuario llamada `PHPRC` con valor `C:\php`.

4. **Dentro de `php.ini`, quita el `;` del inicio** de estas líneas:
   ```
   extension_dir = "ext"
   extension=pdo_pgsql
   extension=fileinfo
   extension=mbstring
   extension=openssl
   extension=curl
   extension=zip
   extension=gd
   ```
   Verifica con `php -m` que aparezcan en la lista.

---

## 2. Clonar el proyecto

1. Acepta la invitación al repositorio que te llegó por correo o en las notificaciones de GitHub.
2. Abre VS Code. En la pantalla de inicio, click en **"Clonar el repositorio Git..."**
3. Pega esta URL:
   ```
   https://github.com/JeshuaRafaelChaconMolina/plataforma-ciencias-humanas.git
   ```
4. Elige dónde guardarlo (ej. tu Escritorio) y abre la carpeta cuando VS Code lo pregunte.
5. Inicia sesión en GitHub cuando te lo pida (usa la opción **"Sign in with your browser"**).

---

## 3. Configurar el proyecto

Abre la terminal integrada de VS Code (**Terminal → Nueva terminal**) y corre estos comandos **en orden**, esperando a que cada uno termine:

```
composer install
```

Copia el archivo de entorno:
```
copy .env.example .env
php artisan key:generate
```

Abre el archivo `.env` y ajusta **tus** datos de PostgreSQL:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ciencias_humanas
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña_de_postgres
```

> ⚠️ Cada variable debe ir en **su propia línea**. Si dos quedan pegadas, Laravel da un error de "dotenv".

Crea la base de datos. Corre `psql -U postgres`, escribe tu contraseña, y luego:
```
CREATE DATABASE ciencias_humanas;
\q
```

Instala la autenticación y compila los estilos:
```
composer require laravel/breeze --dev
php artisan breeze:install livewire
npm install
npm run build
```

> ⚠️ **Importante:** el instalador de Breeze **sobrescribe** archivos del proyecto con versiones genéricas suyas. Después de correrlo, revisa con el panel de Git de VS Code si modificó alguno de estos y **descarta esos cambios** (click derecho → Descartar cambios):
> - `routes/web.php`
> - `resources/css/app.css`
> - `tailwind.config.js`
> - `resources/views/layouts/app.blade.php`
> - `resources/views/components/layouts/app.blade.php`

Crea las tablas y datos iniciales:
```
php artisan migrate --seed
php artisan storage:link
```

---

## 4. Ejecutar el proyecto

```
php artisan serve
```

Abre `http://localhost:8000` en tu navegador. Deja esa terminal abierta mientras trabajas.

**Usuario administrador de prueba:**
- Correo: `admin@ciencias-humanas.local`
- Contraseña: `CambiarEstaClave123!`

Cada quien tiene su propia base de datos local, así que el contenido que cargues **no** lo verán los demás.

---

## 5. Trabajo diario en equipo (Git desde VS Code)

El panel de Git está en el icono de rama en la barra lateral izquierda, o con `Ctrl+Shift+G`.

**Antes de empezar a trabajar** — trae los cambios de los demás:
- Click en el icono de sincronizar (flechas circulares) junto a `main`, abajo a la izquierda.

**Cuando termines algo** — sube tus cambios:
1. En el panel de Git, pasa el mouse sobre **"Cambios"** y click en el **`+`** (agrega todos los archivos).
2. Escribe un mensaje describiendo qué hiciste.
3. Click en el botón azul **"Confirmación"**.
4. Click en **sincronizar** para subirlo a GitHub.

### Recomendaciones para no pisarse el trabajo

- Avísense antes de empezar qué módulo o archivo va a tocar cada quien.
- Sincroniza seguido (al empezar y al terminar cada sesión), no acumules días de cambios.
- Si dos personas editan el mismo archivo, Git marcará un "conflicto" que hay que resolver a mano — mejor prevenirlo coordinándose.

---

## 6. Si algo falla

| Error | Posible causa |
|---|---|
| `php no se reconoce...` | PHP no está en el PATH, o no cerraste/abriste PowerShell |
| `Loaded Configuration File: (none)` | El `php.ini` se llama mal (`php.ini.ini`) o falta `PHPRC` |
| `could not find driver` | Falta activar `extension=pdo_pgsql` en `php.ini` |
| `Failed to parse dotenv file` | Dos variables quedaron en la misma línea en el `.env` |
| `Route [x] not defined` | Breeze sobrescribió `routes/web.php` — restáuralo |
| El sitio se ve sin colores | Falta correr `npm run build` |
| Cambios que no se reflejan | Corre `php artisan view:clear` |

---

## 7. Estructura del proyecto (referencia rápida)

```
app/Models/                  Modelos (Course, Article, User, etc.)
app/Livewire/Admin/          Panel administrativo (listados y formularios)
app/Http/Controllers/Public/ Controladores del portal público
database/migrations/         Estructura de la base de datos
database/seeders/            Roles, permisos, usuario admin, categorías
resources/views/layouts/     Diseño base (público y privado)
resources/views/public/      Portal público
resources/views/livewire/    Vistas del panel administrativo
routes/web.php               Rutas públicas y privadas
routes/admin.php             Rutas del panel administrativo
```

---

## 8. Roles del sistema

| Rol | Puede hacer |
|---|---|
| **Administrador** | Todo: usuarios, categorías, todo el contenido del portal, métricas |
| **Investigador** | Publicar y editar artículos, libros y revistas |
| **Docente** | Sin acceso al panel por ahora (sus funciones llegarán con Moodle, Fase 6) |
| **Alumno** | Ver el catálogo de oferta educativa publicada |
