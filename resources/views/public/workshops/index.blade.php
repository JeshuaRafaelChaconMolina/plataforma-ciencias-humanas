<x-layouts.public :title="'Talleres'">
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="section-title">Talleres</h1>
        <div class="accent-stripe my-4"></div>

        @if($workshops->isEmpty())
            <p class="text-slate-500">Aun no hay talleres publicados.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($workshops as $workshop)
                    <div class="card flex flex-col overflow-hidden p-0">
                        @if($workshop->image)
                            <img src="{{ asset('storage/' . $workshop->image) }}" alt="{{ $workshop->title }}" class="h-40 w-full object-cover">
                        @endif
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="text-lg font-bold text-primary-800">{{ $workshop->title }}</h3>
                            <p class="mt-2 flex-1 text-sm text-slate-600">{{ Str::limit($workshop->purpose, 100) }}</p>
                            <a href="{{ route('workshops.show', $workshop) }}" class="btn-primary mt-4 w-fit">Ver detalle</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">{{ $workshops->links() }}</div>
        @endif
    </section>
</x-layouts.public>
