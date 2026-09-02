<x-layouts.public :title="$course->title">
    <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        @if($course->image)
            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="mb-6 h-64 w-full rounded-xl object-cover">
        @endif
        <x-badge color="accent">{{ $course->category?->name ?? 'Curso' }}</x-badge>
        <h1 class="mt-4 text-3xl font-extrabold text-primary-800">{{ $course->title }}</h1>

        <div class="mt-6 space-y-4 text-slate-700">
            <div>
                <h2 class="font-semibold text-primary-700">Proposito</h2>
                <p>{{ $course->purpose }}</p>
            </div>

            @if($course->modules->isNotEmpty())
                <div>
                    <h2 class="font-semibold text-primary-700">Modulos</h2>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach($course->modules as $module)
                            <li>{{ $module->title }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        @if($course->moodleLink?->is_active && $course->moodleLink?->moodle_url)
            <a href="{{ $course->moodleLink->moodle_url }}" target="_blank" rel="noopener" class="btn-accent mt-8 inline-block">
                INGRESAR AL CURSO
            </a>
        @else
            <p class="mt-8 text-sm text-slate-400">Este curso aun no tiene un enlace de Moodle configurado.</p>
        @endif
    </article>
</x-layouts.public>
