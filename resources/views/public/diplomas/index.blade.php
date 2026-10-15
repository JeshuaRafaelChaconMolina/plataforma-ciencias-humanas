<x-layouts.public :title="'Diplomados'">
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="section-title">Diplomados</h1>
        <div class="accent-stripe my-4"></div>

        @if($diplomas->isEmpty())
            <p class="text-slate-500">Aún no hay diplomados publicados.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($diplomas as $diploma)
                    <div class="card flex flex-col overflow-hidden p-0">
                        @if($diploma->image)
                            <img src="{{ asset('storage/' . $diploma->image) }}" alt="{{ $diploma->title }}" class="h-40 w-full object-cover">
                        @endif
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="text-lg font-bold text-primary-800">{{ $diploma->title }}</h3>
                            <p class="mt-2 flex-1 text-sm text-slate-600">{{ Str::limit($diploma->purpose, 100) }}</p>
                            <a href="{{ route('diplomas.show', $diploma) }}" class="btn-primary mt-4 w-fit">Ver detalle</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">{{ $diplomas->links() }}</div>
        @endif
    </section>
</x-layouts.public>
