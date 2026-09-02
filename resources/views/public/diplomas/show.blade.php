<x-layouts.public :title="$diploma->title">
    <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        @if($diploma->image)
            <img src="{{ asset('storage/' . $diploma->image) }}" alt="{{ $diploma->title }}" class="mb-6 h-64 w-full rounded-xl object-cover">
        @endif
        <x-badge color="accent">Diplomado</x-badge>
        <h1 class="mt-4 text-3xl font-extrabold text-primary-800">{{ $diploma->title }}</h1>
        <p class="mt-6 text-slate-700">{{ $diploma->purpose ?? $diploma->description }}</p>

        @if($diploma->courses->isNotEmpty())
            <div class="mt-6">
                <h2 class="font-semibold text-primary-700">Cursos que lo integran</h2>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach($diploma->courses as $course)
                        <li><a class="text-primary-700 hover:underline" href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </article>
</x-layouts.public>
