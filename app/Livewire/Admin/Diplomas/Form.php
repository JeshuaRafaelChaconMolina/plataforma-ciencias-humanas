<?php

namespace App\Livewire\Admin\Diplomas;

use App\Models\Diploma;
use App\Models\Category;
use App\Models\DiplomaModule;
use App\Models\MoodleCourseLink;
use App\Services\MoodleService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Diploma $diploma = null;

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

    // Módulos del diplomado: cada uno es
    // ['title' => '', 'description' => '', 'lessons' => [['title' => ''], ...]]
    // Las lecciones son solo una lista de títulos dentro del módulo.
    // Sin imagen por módulo: la portada es la del diplomado.
    public array $modules = [];

    // Vínculo con Moodle
    public string $moodle_url = '';
    public bool $moodle_is_active = true;

    // Alerta visible en el formulario cuando Moodle falla o falta configurar.
    // El diplomado de Laravel se guarda igual; esto solo avisa que el enlace no se creó solo.
    public ?string $moodleError = null;
    public ?string $moodleNotice = null;

    public function mount($diploma = null)
    {
        abort_unless(auth()->user()->can($diploma ? 'editar_diplomados' : 'crear_diplomados'), 403);

        if ($diploma) {
            $diplomaId = $diploma instanceof Diploma ? $diploma->getKey() : $diploma;
            $this->diploma = Diploma::with(['modules.lessons', 'moodleLink'])->findOrFail($diplomaId);
            $this->title = $this->diploma->title;
            $this->category_id = $this->diploma->category_id;
            $this->description = (string) $this->diploma->description;
            $this->purpose = (string) $this->diploma->purpose;
            $this->duration = (string) $this->diploma->duration;
            $this->modality = (string) $this->diploma->modality;
            $this->status = $this->diploma->status;
            $this->start_date = optional($this->diploma->start_date)->format('Y-m-d');
            $this->end_date = optional($this->diploma->end_date)->format('Y-m-d');
            $this->existingImage = $this->diploma->image;

            $this->modules = $this->diploma->modules->map(fn ($m) => [
                'title' => $m->title,
                'description' => (string) $m->description,
                'lessons' => $m->lessons->map(fn ($l) => ['title' => $l->title])->toArray(),
            ])->toArray();

            if ($this->diploma->moodleLink) {
                $this->moodle_url = (string) $this->diploma->moodleLink->moodle_url;
                $this->moodle_is_active = (bool) $this->diploma->moodleLink->is_active;
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
            // así que no debe bloquear todo el diplomado.
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
            $data['image'] = $this->image->store('diplomas', 'public');
        }

        if ($this->diploma) {
            $this->diploma->update($data);
        } else {
            $this->diploma = Diploma::create($data + ['created_by' => auth()->id()]);
        }

        // Reemplaza los módulos existentes por los capturados en el formulario.
        // Las lecciones se borran aparte: la relación polimórfica no
        // tiene llave foránea en cascada.
        foreach ($this->diploma->modules as $existingModule) {
            $existingModule->lessons()->delete();
        }
        $this->diploma->modules()->delete();
        foreach ($this->modules as $index => $module) {
            if (trim($module['title'] ?? '') === '') {
                continue;
            }
            $created = DiplomaModule::create([
                'diploma_id' => $this->diploma->id,
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
        //    y se guarda la URL que devuelve. Si eso falla, el diplomado de Laravel
        //    queda guardado igual y se muestra la alerta en el formulario.
        // El shortname lleva el sufijo "-diplomado" para no chocar con un
        // curso del mismo título y mismo id en Moodle.
        $this->moodleError = null;
        $this->moodleNotice = null;
        $moodleCourseId = $this->diploma->moodleLink?->moodle_course_id;
        $linkKey = ['diploma_id' => $this->diploma->id];

        if (trim($this->moodle_url) !== '') {
            MoodleCourseLink::updateOrCreate(
                $linkKey,
                ['moodle_url' => $this->moodle_url, 'moodle_course_id' => $moodleCourseId, 'is_active' => $this->moodle_is_active]
            );
        } else {
            $result = app(MoodleService::class)->createCourse(
                $this->diploma->title,
                $this->diploma->title.'-diplomado',
                (string) $this->diploma->description,
                $this->diploma->id
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
                if (! $this->diploma->moodleLink) {
                    MoodleCourseLink::where('diploma_id', $this->diploma->id)->delete();
                }
                $this->moodleError = 'El diplomado se guardó en Laravel, pero no se pudo crear el aula en Moodle automáticamente: '.$result['error'].' Puedes crear el curso en Moodle y pegar su URL en la sección 5.';
            }
        }

        if ($this->moodleError !== null) {
            // Se queda en el formulario para que la alerta se vea,
            // sin perder lo que ya se guardó.
            return;
        }

        session()->flash('status', 'Diplomado guardado correctamente.'.($this->moodleNotice ? ' '.$this->moodleNotice : ''));

        return redirect()->route('admin.diplomas.index');
    }

    public function render()
    {
        return view('livewire.admin.diplomas.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->diploma ? 'Editar diplomado' : 'Nuevo diplomado']);
    }
}
