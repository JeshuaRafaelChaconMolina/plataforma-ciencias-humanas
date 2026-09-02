<x-layouts.public :title="'Articulos'">
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="section-title">Articulos</h1>
        <div class="accent-stripe my-4"></div>

        <form method="GET" class="mb-8 flex flex-wrap gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por titulo..."
                   class="w-full max-w-sm rounded-lg border-slate-200 text-sm sm:w-auto">
            <button type="submit" class="btn-primary">Buscar</button>
        </form>

        @if($items->isEmpty())
            <p class="text-slate-500">No se encontraron resultados.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($items as $item)
                    <x-card :title="$item->title" :category="$item->category?->name" href="{{ url()->current() }}/{{ $item->slug }}">
                        {{ Str::limit($item->description, 110) }}
                    </x-card>
                @endforeach
            </div>

            <div class="mt-10">{{ $items->links() }}</div>
        @endif
    </section>
</x-layouts.public>
