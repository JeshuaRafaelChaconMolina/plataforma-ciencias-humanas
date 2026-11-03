<x-layouts.public :title="'Talleres'">
    <div class="bg-gradient-to-b from-primary-950 via-primary-900 to-slate-900 py-14 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 rounded-full bg-accent-500/10 px-3.5 py-1 text-xs font-semibold text-accent-300 mb-3 border border-accent-400/20">
                <span class="h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                <span>Formación Práctica y Dinámica</span>
            </div>
            <h1 class="text-3xl font-black sm:text-4xl lg:text-5xl tracking-tight">Talleres</h1>
            <p class="mt-3 max-w-2xl text-sm sm:text-base text-slate-300">
                Aprende metodologías, herramientas y aplicaciones directas para la investigación y el ejercicio profesional.
            </p>
        </div>
    </div>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        @if($workshops->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 mb-4">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">Aún no hay talleres publicados</h3>
                <p class="mt-1 text-sm text-slate-500">Pronto se anunciarán las fechas de los próximos talleres prácticos.</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($workshops as $workshop)
                    <x-card :title="$workshop->title"
                            :href="route('workshops.show', $workshop)"
                            category="Taller"
                            :image="$workshop->image"
                            actionText="Ver taller">
                        {{ Str::limit($workshop->purpose ?? $workshop->description, 110) }}
                    </x-card>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $workshops->links() }}
            </div>
        @endif
    </section>
</x-layouts.public>
