<x-layouts.public :title="'Inicio'">

    {{-- HERO SECTION PRINCIPAL --}}
    <section class="relative overflow-hidden bg-slate-950 py-24 sm:py-32 text-white">
        {{-- Fondo Fotográfico de Biblioteca Universitaria y Efectos de Iluminación Institucionales --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            {{-- Imagen de biblioteca con overlay institucional para garantizar máximo contraste y legibilidad --}}
            <img src="{{ asset('images/library-bg.jpg') }}" alt="Biblioteca Ciencias Humanas" class="h-full w-full object-cover object-center opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-primary-950/90 to-primary-900/75"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/60"></div>
            <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-primary-600/20 blur-[120px]"></div>
            <div class="absolute -bottom-20 left-10 h-[380px] w-[380px] rounded-full bg-accent-500/15 blur-[100px]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff0a_1px,transparent_1px)] [background-size:24px_24px] opacity-25"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-12">
                {{-- Columna de contenido textual --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full border border-accent-400/30 bg-accent-500/10 px-4 py-1.5 text-xs font-semibold text-accent-300 backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-accent-400 animate-pulse"></span>
                        <span>Portal Académico e Institucional</span>
                    </div>

                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl text-white leading-tight">
                        Conocimiento que inspira,
                        <span class="block font-serif italic font-normal text-accent-300">educación</span>
                        que transforma.
                    </h1>

                    <p class="max-w-xl text-base sm:text-lg leading-relaxed text-slate-300">
                        Espacio universitario para la difusión científica y formación integral: consulta artículos de investigación, libros, revistas y descubre nuestra oferta de cursos, diplomados y talleres.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('courses.index') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-accent-500 px-6 py-3.5 text-sm font-bold text-primary-950 shadow-lg shadow-accent-500/20 transition-all duration-200 hover:bg-accent-400 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-accent-400 focus:ring-offset-2 focus:ring-offset-slate-900">
                            <span>Ver oferta de cursos</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>

                        <a href="{{ route('library.index') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/20 bg-white/10 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-200 hover:bg-white/20 hover:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/40">
                            <svg class="h-4 w-4 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span>Biblioteca Virtual</span>
                        </a>
                    </div>
                </div>

                {{-- Columna con tarjeta visual destacada --}}
                <div class="hidden lg:col-span-5 lg:block">
                    <div class="relative mx-auto max-w-md">
                        <div class="absolute -right-4 -bottom-4 h-full w-full rounded-3xl border border-accent-400/30"></div>
                        <div class="relative rounded-3xl border border-white/10 bg-slate-900/80 p-8 backdrop-blur-xl shadow-2xl">
                            <div class="flex items-center justify-between pb-6 border-b border-white/10">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-3 w-3 rounded-full bg-accent-400"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Ciencias Humanas</span>
                                </div>
                                <span class="rounded-full bg-primary-600/30 px-3 py-1 text-[11px] font-semibold text-primary-200 border border-primary-500/20">
                                    Acceso Libre
                                </span>
                            </div>

                            <div class="py-6 space-y-4">
                                <p class="font-serif text-2xl italic text-slate-100 leading-snug">
                                    "El pensamiento crítico y la investigación son los pilares del desarrollo humano."
                                </p>
                                <p class="text-xs text-slate-400">
                                    Explora contenidos avalados y revisados por nuestra comunidad académica de docentes e investigadores.
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-4 border-t border-white/10 text-xs">
                                <div class="rounded-xl bg-white/5 p-3">
                                    <span class="block text-accent-400 font-bold text-base">Cursos</span>
                                    <span class="text-slate-400">Oferta continua</span>
                                </div>
                                <div class="rounded-xl bg-white/5 p-3">
                                    <span class="block text-accent-400 font-bold text-base">Biblioteca</span>
                                    <span class="text-slate-400">Artículos y libros</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FRANJA DE 4 PILARES DE EXPLORACIÓN --}}
    <section class="relative z-10 -mt-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Pilar 1: Biblioteca --}}
            <a href="{{ route('library.index') }}"
               class="group flex items-center gap-4 rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-700 transition group-hover:bg-primary-700 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary-700">Biblioteca Virtual</h3>
                    <p class="text-xs text-slate-500">Artículos, libros y revistas</p>
                </div>
            </a>

            {{-- Pilar 2: Cursos --}}
            <a href="{{ route('courses.index') }}"
               class="group flex items-center gap-4 rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-700 transition group-hover:bg-primary-700 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary-700">Cursos</h3>
                    <p class="text-xs text-slate-500">Formación académica</p>
                </div>
            </a>

            {{-- Pilar 3: Diplomados --}}
            <a href="{{ route('diplomas.index') }}"
               class="group flex items-center gap-4 rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-700 transition group-hover:bg-primary-700 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="9" r="5.5" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary-700">Diplomados</h3>
                    <p class="text-xs text-slate-500">Programas de especialización</p>
                </div>
            </a>

            {{-- Pilar 4: Talleres --}}
            <a href="{{ route('workshops.index') }}"
               class="group flex items-center gap-4 rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-700 transition group-hover:bg-primary-700 group-hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary-700">Talleres</h3>
                    <p class="text-xs text-slate-500">Aprendizaje práctico</p>
                </div>
            </a>
        </div>
    </section>

    {{-- SECCIÓN DE CURSOS DESTACADOS --}}
    <section class="mx-auto max-w-7xl px-4 pt-20 pb-16 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-8 border-b border-slate-200/80">
            <div>
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-2">
                    <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                    <span>Capacitación y Cursos</span>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Cursos destacados
                </h2>
                <p class="mt-2 text-sm text-slate-600 max-w-xl">
                    Conoce las opciones formativas impartidas por especialistas en disciplinas humanísticas y sociales.
                </p>
            </div>

            <a href="{{ route('courses.index') }}"
               class="inline-flex items-center gap-1.5 text-sm font-bold text-primary-700 hover:text-primary-800 group">
                <span>Ver todos los cursos</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="mt-8">
            @if($courses->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 mb-4">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Aún no hay cursos publicados</h3>
                    <p class="mt-1 text-sm text-slate-500">Pronto estarán disponibles nuevas convocatorias y contenidos.</p>
                </div>
            @else
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($courses as $course)
                        <x-card :title="$course->title"
                                :href="route('courses.show', $course)"
                                :category="$course->category?->name ?? 'Curso'"
                                :image="$course->image"
                                actionText="Ver curso">
                            {{ Str::limit($course->purpose ?? $course->description, 110) }}
                        </x-card>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- SECCIÓN DE DIPLOMADOS Y TALLERES --}}
    <section class="bg-slate-100/60 py-20 border-y border-slate-200/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-8 border-b border-slate-200/80">
                <div>
                    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-2">
                        <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                        <span>Programas de Especialización</span>
                    </div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                        Diplomados y talleres
                    </h2>
                    <p class="mt-2 text-sm text-slate-600 max-w-xl">
                        Profundiza tus conocimientos y adquiere habilidades prácticas para el ámbito profesional y académico.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('diplomas.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Ver diplomados</a>
                    <span class="text-slate-300">•</span>
                    <a href="{{ route('workshops.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Ver talleres</a>
                </div>
            </div>

            <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($diplomas as $diploma)
                    <x-card :title="$diploma->title"
                            :href="route('diplomas.show', $diploma)"
                            category="Diplomado"
                            :image="$diploma->image"
                            actionText="Ver diplomado">
                        {{ Str::limit($diploma->purpose ?? $diploma->description, 110) }}
                    </x-card>
                @endforeach

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
        </div>
    </section>

    {{-- BANNER DE INVITACIÓN / COMUNIDAD ACADÉMICA --}}
    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary-900 via-primary-800 to-primary-950 p-8 sm:p-12 text-white shadow-xl">
            <div class="pointer-events-none absolute -right-20 -bottom-20 h-80 w-80 rounded-full bg-accent-500/20 blur-3xl"></div>

            <div class="relative z-10 grid items-center gap-8 lg:grid-cols-12">
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1 text-xs font-semibold text-accent-300">
                        <span>Investigación y Docencia</span>
                    </div>
                    <h3 class="text-2xl font-black sm:text-3xl lg:text-4xl">
                        ¿Perteneces a nuestra comunidad docente o investigadora?
                    </h3>
                    <p class="text-sm sm:text-base text-primary-100 max-w-2xl leading-relaxed">
                        Accede al panel para gestionar publicaciones en el repositorio, publicar nuevos cursos vinculados con Moodle y participar activamente en la difusión del conocimiento científico.
                    </p>
                </div>

                <div class="lg:col-span-4 flex lg:justify-end">
                    @auth
                        <a href="{{ route('dashboard.index') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-accent-500 px-6 py-3.5 text-sm font-bold text-primary-950 shadow-md transition hover:bg-accent-400 hover:shadow-lg">
                            <span>Ingresar a mi panel</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-accent-500 px-6 py-3.5 text-sm font-bold text-primary-950 shadow-md transition hover:bg-accent-400 hover:shadow-lg">
                            <span>Iniciar sesión institucional</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
