<x-layouts.app :title="'Mi panel'">
    <div class="card max-w-2xl">
        <h2 class="text-lg font-bold text-primary-800">Bienvenido, {{ auth()->user()->name }}</h2>
        <p class="mt-2 text-sm text-slate-600">
            Este es tu panel como docente. La publicacion de tareas, actividades, materiales, imagenes y videos
            para tus alumnos estara disponible aqui cuando la integracion con Moodle este activa (Fase 6).
            El portal público institucional (articulos, cursos, diplomados, talleres) es administrado
            unicamente por el administrador de la plataforma.
        </p>
    </div>
</x-layouts.app>
