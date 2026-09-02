<x-layouts.public :title="$workshop->title">
    <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        @if($workshop->image)
            <img src="{{ asset('storage/' . $workshop->image) }}" alt="{{ $workshop->title }}" class="mb-6 h-64 w-full rounded-xl object-cover">
        @endif
        <x-badge color="accent">Taller</x-badge>
        <h1 class="mt-4 text-3xl font-extrabold text-primary-800">{{ $workshop->title }}</h1>
        <p class="mt-6 text-slate-700">{{ $workshop->purpose ?? $workshop->description }}</p>
    </article>
</x-layouts.public>
