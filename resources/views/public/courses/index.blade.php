<x-layouts.public :title="'Cursos'">
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="section-title">Cursos</h1>
        <div class="accent-stripe my-4"></div>

        <form method="GET" class="mb-8 flex flex-wrap gap-3">
            <label for="course-search" class="sr-only">Buscar curso</label>
            <input id="course-search" type="text" name="q" value="{{ request('q') }}" placeholder="Buscar curso..."
                    class="w-full max-w-sm rounded-lg border-slate-200 text-sm sm:w-auto">
            <button type="submit" class="btn-primary">Buscar</button>
        </form>

        @if($courses->isEmpty())
            <p class="text-slate-500">Aún no hay cursos publicados.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($courses as $course)
                    <div class="card flex flex-col overflow-hidden p-0">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="h-40 w-full object-cover">
                        @endif
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="text-lg font-bold text-primary-700">{{ $course->title }}</h3>
                            <p class="mt-2 flex-1 text-sm text-slate-600">{{ Str::limit($course->purpose, 100) }}</p>
                            <a href="{{ route('courses.show', $course) }}" class="btn-primary mt-4 w-fit">Ver detalle</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">{{ $courses->links() }}</div>
        @endif
    </section>
</x-layouts.public>
