@props(['title', 'href' => null, 'category' => null, 'image' => null])

<div class="card flex flex-col overflow-hidden p-0">
    @if($image)
        <img src="{{ asset('storage/' . $image) }}" alt="{{ $title }}" class="h-40 w-full object-cover">
    @endif

    <div class="flex flex-1 flex-col p-5">
        @if($category)
            <span class="mb-2 inline-block w-fit rounded-full bg-accent-500/20 px-3 py-1 text-xs font-semibold text-primary-800">
                {{ $category }}
            </span>
        @endif

        <h3 class="text-lg font-bold text-primary-800">{{ $title }}</h3>

        <div class="mt-2 flex-1 text-sm text-slate-600">
            {{ $slot }}
        </div>

        @if($href)
            <a href="{{ $href }}" class="btn-primary mt-4 w-fit">Ver mas</a>
        @endif
    </div>
</div>
