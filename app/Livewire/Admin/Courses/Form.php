<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseModule;
use App\Models\MoodleCourseLink;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Course $course = null;

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

    // Módulos del curso: cada uno es ['title' => '', 'description' => '']
    public array $modules = [];

    // Vínculo con Moodle
    public string $moodle_url = '';
    public bool $moodle_is_active = true;

    public function mount($course = null)
    {
        abort_unless(auth()->user()->can($course ? 'editar_cursos' : 'crear_cursos'), 403);

        if ($course) {
            $courseId = $course instanceof Course ? $course->getKey() : $course;
            $this->course = Course::with(['modules', 'moodleLink'])->findOrFail($courseId);
            $this->title = $this->course->title;
            $this->category_id = $this->course->category_id;
            $this->description = (string) $this->course->description;
            $this->purpose = (string) $this->course->purpose;
            $this->duration = (string) $this->course->duration;
            $this->modality = (string) $this->course->modality;
            $this->status = $this->course->status;
            $this->start_date = optional($this->course->start_date)->format('Y-m-d');
            $this->end_date = optional($this->course->end_date)->format('Y-m-d');
            $this->existingImage = $this->course->image;

            $this->modules = $this->course->modules->map(fn ($m) => [
                'title' => $m->title,
                'description' => (string) $m->description,
            ])->toArray();

            if ($this->course->moodleLink) {
                $this->moodle_url = (string) $this->course->moodleLink->moodle_url;
                $this->moodle_is_active = (bool) $this->course->moodleLink->is_active;
            }
        }
    }

    public function addModule()
    {
        $this->modules[] = ['title' => '', 'description' => ''];
    }

    public function removeModule($index)
    {
        unset($this->modules[$index]);
        $this->modules = array_values($this->modules);
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
            'modules.*.title' => 'required_with:modules|string|max:255',
            'modules.*.description' => 'nullable|string',
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
            $data['image'] = $this->image->store('courses', 'public');
        }

        if ($this->course) {
            $this->course->update($data);
        } else {
                $this->course = Course::create($data + ['created_by' => auth()->id()]);
        }

        // Reemplaza los módulos existentes por los capturados en el formulario
        $this->course->modules()->delete();
        foreach ($this->modules as $index => $module) {
            if (trim($module['title'] ?? '') === '') {
                continue;
            }
            CourseModule::create([
                'course_id' => $this->course->id,
                'title' => $module['title'],
                'description' => $module['description'] ?? '',
                'order' => $index,
            ]);
        }

        // Vínculo con Moodle (se guarda solo si se capturo una URL)
        if (trim($this->moodle_url) !== '') {
            MoodleCourseLink::updateOrCreate(
                ['course_id' => $this->course->id],
                ['moodle_url' => $this->moodle_url, 'is_active' => $this->moodle_is_active]
            );
        } 
        else {
            MoodleCourseLink::where('course_id', $this->course->id)->delete();
        }

        session()->flash('status', 'Curso guardado correctamente.');

        return redirect()->route('admin.courses.index');
    }

    public function render()
    {
        return view('livewire.admin.courses.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->course ? 'Editar curso' : 'Nuevo curso']);
    }
}
