<?php

namespace App\Models;

use App\Models\Concerns\HasEducationalOffering;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, HasEducationalOffering;

    protected $fillable = [
        'category_id', 'created_by', 'title', 'slug', 'description', 'purpose',
        'image', 'duration', 'modality', 'status', 'start_date', 'end_date',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('order');
    }

    public function moodleLink()
    {
        return $this->hasOne(MoodleCourseLink::class);
    }

    // Preparado para el futuro (diplomado compuesto por varios cursos)
    public function diplomas()
    {
        return $this->belongsToMany(Diploma::class, 'diploma_courses')->withPivot('order')->withTimestamps();
    }
}
