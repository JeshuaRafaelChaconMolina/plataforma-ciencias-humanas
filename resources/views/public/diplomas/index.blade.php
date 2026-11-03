<x-layouts.public :title="'Diplomados'">
    <div class="bg-gradient-to-b from-primary-950 via-primary-900 to-slate-900 py-14 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 rounded-full bg-accent-500/10 px-3.5 py-1 text-xs font-semibold text-accent-300 mb-3 border border-accent-400/20">
                <span class="h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                <span>Programas de Posgrado y Actualización</span>
            </div>
            <h1 class="text-3xl font-black sm:text-4xl lg:text-5xl tracking-tight">Diplomados</h1>
            <p class="mt-3 max-w-2xl text-sm sm:text-base text-slate-300">
                Especialízate con programas estructurados en módulos y cursos integrados por académicos expertos.
            </p>
        </div>
    </div>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        @if($diplomas->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 mb-4">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="9" r="5.5" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Aún no hay diplomados publicados</h3>
                <p class="mt-1 text-sm text-slate-500">Pronto estará disponible la oferta de diplomados para el ciclo actual.</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($diplomas as $diploma)
                    <x-card :title="$diploma->title"
                            :href="route('diplomas.show', $diploma)"
                            category="Diplomado"
                            :image="$diploma->image"
                            actionText="Ver diplomado">
                        {{ Str::limit($diploma->purpose ?? $diploma->description, 110) }}
                    </x-card>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $diplomas->links() }}
            </div>
        @endif
    </section>
</x-layouts.public>
