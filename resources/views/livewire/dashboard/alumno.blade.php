<x-layouts.app :title="'Mi panel'">
    <div class="card mb-6 max-w-2xl">
        <h2 class="text-lg font-bold text-primary-800">Bienvenido, {{ auth()->user()->name }}</h2>
        <p class="mt-2 text-sm text-slate-600">
            Este es tu panel como alumno. Aqui puedes consultar la oferta educativa disponible. El seguimiento
            de tus cursos inscritos estara disponible cuando la integracion con Moodle este activa (Fase 6).
        </p>
    </div>

    <h3 class="section-title text-xl">Cursos disponibles</h3>
    <div class="accent-stripe my-3"></div>
    @if($cursos->isEmpty())
        <p class="mb-8 text-sm text-slate-500">Aun no hay cursos publicados.</p>
    @else
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($cursos as $curso)
                <x-card :title="$curso->title" :href="route('courses.show', $curso)" :image="$curso->image">
                    {{ Str::limit($curso->purpose ?? $curso->description, 90) }}
                </x-card>
            @endforeach
        </div>
    @endif

    <h3 class="section-title text-xl">Diplomados disponibles</h3>
    <div class="accent-stripe my-3"></div>
    @if($diplomados->isEmpty())
        <p class="mb-8 text-sm text-slate-500">Aun no hay diplomados publicados.</p>
    @else
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($diplomados as $diplomado)
                <x-card :title="$diplomado->title" :href="route('diplomas.show', $diplomado)" :image="$diplomado->image">
                    {{ Str::limit($diplomado->purpose ?? $diplomado->description, 90) }}
                </x-card>
            @endforeach
        </div>
    @endif

    <h3 class="section-title text-xl">Talleres disponibles</h3>
    <div class="accent-stripe my-3"></div>
    @if($talleres->isEmpty())
        <p class="text-sm text-slate-500">Aun no hay talleres publicados.</p>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($talleres as $taller)
                <x-card :title="$taller->title" :href="route('workshops.show', $taller)" :image="$taller->image">
                    {{ Str::limit($taller->purpose ?? $taller->description, 90) }}
                </x-card>
            @endforeach
        </div>
    @endif
</x-layouts.app>
