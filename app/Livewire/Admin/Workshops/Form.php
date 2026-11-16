<?php

namespace App\Livewire\Admin\Workshops;

use App\Models\Workshop;
use App\Models\Category;
use App\Models\WorkshopModule;
use App\Models\MoodleCourseLink;
use App\Services\MoodleService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Workshop $workshop = null;

    public string $title = '';
    public ?int $category_id = null;
    public string $description = '';
    public string $purpose = '';
    public string $duration = '';
    public string $modality = '';
    public string $status = 'draft';
    public ?string $start_date = null;
    public ?string $end_date = null;
    public $image;
    public ?string $existingImage = null;

    // Módulos del taller: cada uno es
    // ['title' => '', 'description' => '', 'lessons' => [['title' => ''], ...]]
    // Las lecciones son solo una lista de títulos dentro del módulo.
    // Sin imagen por módulo: la portada es la del taller.
    public array $modules = [];

    // Vínculo con Moodle
    public string $moodle_url = '';
    public bool $moodle_is_active = true;

    // Alerta visible en el formulario cuando Moodle falla o falta configurar.
    // El taller de Laravel se guarda igual; esto solo avisa que el enlace no se creó solo.
    public ?string $moodleError = null;
    public ?string $moodleNotice = null;

    public function mount($workshop = null)
    {
        abort_unless(auth()->user()->can($workshop ? 'editar_talleres' : 'crear_talleres'), 403);

        if ($workshop) {
            $workshopId = $workshop instanceof Workshop ? $workshop->getKey() : $workshop;
            $this->workshop = Workshop::with(['modules.lessons', 'moodleLink'])->findOrFail($workshopId);
            $this->title = $this->workshop->title;
            $this->category_id = $this->workshop->category_id;
            $this->description = (string) $this->workshop->description;
            $this->purpose = (string) $this->workshop->purpose;
            $this->duration = (string) $this->workshop->duration;
            $this->modality = (string) $this->workshop->modality;
            $this->status = $this->workshop->status;
            $this->start_date = optional($this->workshop->start_date)->format('Y-m-d');
            $this->end_date = optional($this->workshop->end_date)->format('Y-m-d');
            $this->existingImage = $this->workshop->image;

            $this->modules = $this->workshop->modules->map(fn ($m) => [
                'title' => $m->title,
                'description' => (string) $m->description,
                'lessons' => $m->lessons->map(fn ($l) => ['title' => $l->title])->toArray(),
            ])->toArray();

            if ($this->workshop->moodleLink) {
                $this->moodle_url = (string) $this->workshop->moodleLink->moodle_url;
                $this->moodle_is_active = (bool) $this->workshop->moodleLink->is_active;
            }
        }
    }

    public function addModule()
    {
        $this->modules[] = ['title' => '', 'description' => '', 'lessons' => []];
    }

    public function removeModule($index)
    {
        unset($this->modules[$index]);
        $this->modules = array_values($this->modules);
    }

    public function addLesson($moduleIndex)
    {
        $this->modules[$moduleIndex]['lessons'][] = ['title' => ''];
    }

    public function removeLesson($moduleIndex, $lessonIndex)
    {
        unset($this->modules[$moduleIndex]['lessons'][$lessonIndex]);
        $this->modules[$moduleIndex]['lessons'] = array_values($this->modules[$moduleIndex]['lessons']);
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'purpose' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'modality' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:4096',
            // Un módulo con título vacío se descarta al guardar (ver save()),
            // así que no debe bloquear todo el taller.
            'modules.*.title' => 'nullable|string|max:255',
            'modules.*.description' => 'nullable|string',
            'modules.*.lessons.*.title' => 'nullable|string|max:255',
            'moodle_url' => 'nullable|url|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'purpose' => $this->purpose,
            'duration' => $this->duration,
            'modality' => $this->modality,
            'status' => $this->status,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('workshops', 'public');
        }

        if ($this->workshop) {
            $this->workshop->update($data);
        } else {
            $this->workshop = Workshop::create($data + ['created_by' => auth()->id()]);
        }

        // Reemplaza los módulos existentes por los capturados en el formulario.
        // Las lecciones se borran aparte: la relación polimórfica no
        // tiene llave foránea en cascada.
        foreach ($this->workshop->modules as $existingModule) {
            $existingModule->lessons()->delete();
        }
        $this->workshop->modules()->delete();
        foreach ($this->modules as $index => $module) {
            if (trim($module['title'] ?? '') === '') {
                continue;
            }
            $created = WorkshopModule::create([
                'workshop_id' => $this->workshop->id,
                'title' => $module['title'],
                'description' => $module['description'] ?? '',
                'order' => $index,
            ]);
            foreach ($module['lessons'] ?? [] as $lessonIndex => $lesson) {
                if (trim($lesson['title'] ?? '') === '') {
                    continue;
                }
                $created->lessons()->create([
                    'title' => $lesson['title'],
                    'order' => $lessonIndex,
                ]);
            }
        }

        // Vínculo con Moodle. Mismo patrón que en Cursos:
        // 1) Si el usuario pegó una URL, se guarda tal cual.
        // 2) Si no pegó nada, se intenta crear el curso en Moodle automáticamente
        //    y se guarda la URL que devuelve. Si eso falla, el taller de Laravel
        //    queda guardado igual y se muestra la alerta en el formulario.
        // El shortname lleva el sufijo "-taller" para no chocar con un
        // curso del mismo título y mismo id en Moodle.
        $this->moodleError = null;
        $this->moodleNotice = null;
        $moodleCourseId = $this->workshop->moodleLink?->moodle_course_id;
        $linkKey = ['workshop_id' => $this->workshop->id];

        if (trim($this->moodle_url) !== '') {
            MoodleCourseLink::updateOrCreate(
                $linkKey,
                ['moodle_url' => $this->moodle_url, 'moodle_course_id' => $moodleCourseId, 'is_active' => $this->moodle_is_active]
            );
        } else {
            $result = app(MoodleService::class)->createCourse(
                $this->workshop->title,
                $this->workshop->title.'-taller',
                (string) $this->workshop->description,
                $this->workshop->id
            );

            if ($result['ok']) {
                $this->moodle_url = (string) $result['url'];
                $moodleCourseId = (string) $result['id'];
                MoodleCourseLink::updateOrCreate(
                    $linkKey,
                    ['moodle_url' => $this->moodle_url, 'moodle_course_id' => $moodleCourseId, 'is_active' => $this->moodle_is_active]
                );
                $this->moodleNotice = 'Aula Moodle creada automáticamente: '.$this->moodle_url;
            } else {
                // No se borra el enlace que ya existía; solo se avisa.
                if (! $this->workshop->moodleLink) {
                    MoodleCourseLink::where('workshop_id', $this->workshop->id)->delete();
                }
                $this->moodleError = 'El taller se guardó en Laravel, pero no se pudo crear el aula en Moodle automáticamente: '.$result['error'].' Puedes crear el curso en Moodle y pegar su URL en la sección 5.';
            }
        }

        if ($this->moodleError !== null) {
            // Se queda en el formulario para que la alerta se vea,
            // sin perder lo que ya se guardó.
            return;
        }

        session()->flash('status', 'Taller guardado correctamente.'.($this->moodleNotice ? ' '.$this->moodleNotice : ''));

        return redirect()->route('admin.workshops.index');
    }

    public function render()
    {
        return view('livewire.admin.workshops.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->workshop ? 'Editar taller' : 'Nuevo taller']);
    }
}
