<div class="max-w-4xl space-y-6">
    {{-- Navegación superior / volver --}}
    <div>
        <a href="{{ route('admin.courses.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary-700 transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Volver a Cursos</span>
        </a>
    </div>

    {{-- Tarjeta de formulario --}}
    <div class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-sm">
        <div class="pb-6 border-b border-slate-100">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Oferta Educativa</span>
            </div>
            <h2 class="text-xl font-black text-slate-900">
                {{ $course ? 'Editar Curso' : 'Nuevo Curso de Formación Continua' }}
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Diseña el programa formativo, módulos temáticos y su vinculación con la plataforma Moodle.
            </p>
        </div>

        <form wire:submit="save" class="mt-6 space-y-6">
            {{-- Datos Generales --}}
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">1</span>
                    <span>Información General</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Título del Curso</label>
                    <input type="text"
                           wire:model="title"
                           placeholder="ej. Taller de Escritura Académica y Ensayística"
                           class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    @error('title') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Categoría Temática</label>
                    <select wire:model="category_id"
                            class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        <option value="">Selecciona una categoría (opcional)</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Descripción del Curso</label>
                    <textarea wire:model="description"
                              rows="3"
                              placeholder="Resumen del curso y panorama general de la materia..."
                              class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                    @error('description') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Propósito y Objetivos</label>
                    <textarea wire:model="purpose"
                              rows="2"
                              placeholder="Competencias y habilidades que los participantes adquirirán al concluir..."
                              class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                    @error('purpose') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Modalidad, Fechas y Estado --}}
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">2</span>
                    <span>Duración, Calendario y Visibilidad</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Duración Estimada</label>
                        <input type="text"
                               wire:model="duration"
                               placeholder="ej. 40 horas cronológicas"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('duration') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Modalidad de Impartición</label>
                        <input type="text"
                               wire:model="modality"
                               placeholder="En línea / Presencial / Híbrida"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('modality') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Fecha de Inicio</label>
                        <input type="date"
                               wire:model="start_date"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('start_date') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Fecha de Cierre</label>
                        <input type="date"
                               wire:model="end_date"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('end_date') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Estado del Curso</label>
                        <select wire:model="status"
                                class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                            <option value="draft">Borrador</option>
                            <option value="published">Publicado</option>
                            <option value="archived">Archivado</option>
                        </select>
                        @error('status') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Imagen de Portada --}}
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">3</span>
                    <span>Imagen Promocional</span>
                </h3>

                <div class="rounded-2xl border border-dashed border-slate-300 p-5 bg-slate-50/50">
                    @if($existingImage)
                        <div class="mb-4 flex items-center gap-4">
                            <img src="{{ asset('storage/' . $existingImage) }}" alt="Portada actual" class="h-20 w-32 rounded-xl object-cover shadow-sm border border-slate-200">
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Imagen actual guardada</span>
                                <span class="text-xs text-slate-500">Para reemplazarla, selecciona un nuevo archivo de imagen debajo.</span>
                            </div>
                        </div>
                    @endif

                    <input type="file" wire:model="image" accept="image/*"
                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition">
                    @error('image') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror

                    <div wire:loading wire:target="image" class="mt-2 flex items-center gap-2 text-xs text-primary-700 font-medium">
                        <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Cargando imagen de portada...</span>
                    </div>
                </div>
            </div>

            {{-- Módulos Temáticos --}}
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">4</span>
                        <span>Módulos y Temario</span>
                    </h3>
                    <button type="button" wire:click="addModule"
                            class="inline-flex items-center gap-1 text-xs font-bold text-primary-700 hover:text-primary-900 bg-primary-50 hover:bg-primary-100 px-3 py-1.5 rounded-lg transition">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Agregar Módulo</span>
                    </button>
                </div>

                <div class="space-y-3">
                    @forelse($modules as $index => $module)
                        <div wire:key="module-{{ $index }}" class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-slate-50/60 p-4">
                            <span class="mt-2 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-200 text-slate-700 text-xs font-bold">
                                {{ $index + 1 }}
                            </span>
                            <div class="flex-1 space-y-2">
                                <input type="text"
                                       wire:model="modules.{{ $index }}.title"
                                       placeholder="Título del Módulo (ej. Unidad 1: Fundamentos Históricos)"
                                       class="w-full rounded-xl border-slate-200 px-3.5 py-2 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                                @error("modules.$index.title") <p class="text-xs text-red-600 font-medium">{{ $message }}</p> @enderror

                                <textarea wire:model="modules.{{ $index }}.description"
                                          rows="2"
                                          placeholder="Descripción de temas o actividades de este módulo (opcional)..."
                                          class="w-full rounded-xl border-slate-200 px-3.5 py-2 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                            </div>
                            <button type="button"
                                    wire:click="removeModule({{ $index }})"
                                    class="mt-2 text-xs font-bold text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-50 transition"
                                    title="Eliminar módulo">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed border-slate-200 p-6 text-center text-xs text-slate-400">
                            Aún no se han definido módulos para este curso. Haz clic en "Agregar Módulo" para estructurar el plan de estudios.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Aula Virtual Moodle --}}
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-amber-100 text-amber-800 text-xs font-black">5</span>
                    <span>Vinculación con Aula Virtual (Moodle)</span>
                </h3>

                <div class="rounded-2xl border border-amber-200/70 bg-amber-50/40 p-5 space-y-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Enlace directo al curso en Moodle</label>
                        <div class="relative mt-1.5">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-amber-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>
                            </div>
                            <input type="text"
                                   wire:model="moodle_url"
                                   placeholder="https://moodle.cienciashumanas.edu.mx/course/view.php?id=..."
                                   class="w-full rounded-xl border-amber-300 pl-10 pr-4 py-2.5 text-sm font-mono shadow-sm focus:border-primary-600 focus:ring-primary-600 bg-white">
                        </div>
                        @error('moodle_url') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-center gap-3 text-xs font-semibold text-slate-700 cursor-pointer pt-1">
                        <input type="checkbox"
                               wire:model="moodle_is_active"
                               class="h-4 w-4 rounded border-slate-300 text-primary-700 focus:ring-primary-600">
                        <span>Mostrar el botón institucional "Ingresar al Aula Moodle" en la ficha pública del curso</span>
                    </label>

                    <p class="text-[11px] text-slate-500">
                        Si el aula en Moodle aún está en preparación, puedes dejar este campo en blanco o desmarcar la casilla.
                    </p>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-800">
                    <span>Guardar Curso</span>
                </button>
                <a href="{{ route('admin.courses.index') }}"
                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
