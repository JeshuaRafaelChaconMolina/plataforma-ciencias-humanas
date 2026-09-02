<x-layouts.public :title="$item->title">
    <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <x-badge color="accent">{{ $item->category?->name ?? 'General' }}</x-badge>
        <h1 class="mt-4 text-3xl font-extrabold text-primary-800">{{ $item->title }}</h1>
        <p class="mt-6 whitespace-pre-line text-slate-700">{{ $item->description }}</p>
    </article>
</x-layouts.public>
