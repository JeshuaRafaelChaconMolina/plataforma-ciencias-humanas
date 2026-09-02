<x-layouts.public :title="$item->title">
    <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <x-badge color="accent">{{ $item->category?->name ?? 'General' }}</x-badge>
        <h1 class="mt-4 text-3xl font-extrabold text-primary-800">{{ $item->title }}</h1>
        <p class="mt-6 whitespace-pre-line text-slate-700">{{ $item->description }}</p>

        @php($file = $item->files()->latest()->first())
        @if($file)
            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" rel="noopener" class="btn-primary mt-8 inline-block">
                Descargar archivo adjunto
            </a>
        @endif
    </article>
</x-layouts.public>
