<x-layouts.public :title="'Inicio'">
    <section class="bg-gradient-to-br from-primary-700 to-primary-900 py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <span class="accent-stripe mb-4"></span>
            <h1 class="max-w-2xl text-4xl font-extrabold sm:text-5xl">
                Ciencias Humanas
            </h1>
            <p class="mt-4 max-w-xl text-lg text-primary-100">
                Portal institucional para la difusion de conocimiento cientifico, recursos academicos
                y oferta educativa: cursos, diplomados y talleres.
            </p>
            <div class="mt-8 flex gap-4">
                <a href="{{ route('courses.index') }}" class="btn-accent">Ver cursos</a>
                <a href="{{ route('articles.index') }}" class="rounded-lg border border-white/40 px-5 py-2.5 text-sm font-semibold hover:bg-white/10">
                    Explorar repositorio
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="section-title">Cursos destacados</h2>
        <div class="accent-stripe my-4"></div>

        @if($courses->isEmpty())
            <p class="text-slate-500">Aun no hay cursos publicados.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($courses as $course)
                    <x-card :title="$course->title" :href="route('courses.show', $course)" :category="$course->category?->name" :image="$course->image">
                        {{ Str::limit($course->purpose ?? $course->description, 100) }}
                    </x-card>
                @endforeach
            </div>
        @endif
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <h2 class="section-title">Diplomados y talleres</h2>
        <div class="accent-stripe my-4"></div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($diplomas as $diploma)
                <x-card :title="$diploma->title" :href="route('diplomas.show', $diploma)" category="Diplomado" :image="$diploma->image">
                    {{ Str::limit($diploma->purpose ?? $diploma->description, 100) }}
                </x-card>
            @endforeach

            @foreach($workshops as $workshop)
                <x-card :title="$workshop->title" :href="route('workshops.show', $workshop)" category="Taller" :image="$workshop->image">
                    {{ Str::limit($workshop->purpose ?? $workshop->description, 100) }}
                </x-card>
            @endforeach
        </div>
    </section>
</x-layouts.public>
