<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleCourseLink extends Model
{
    // Un enlace es de un curso, de un diplomado o de un taller.
    // Solo una de course_id / diploma_id / workshop_id tiene valor.
    protected $fillable = ['course_id', 'diploma_id', 'workshop_id', 'moodle_url', 'moodle_course_id', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function diploma()
    {
        return $this->belongsTo(Diploma::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    /**
     * URL final a la que apunta el botón "INGRESAR AL CURSO".
     * Si en el futuro se define SSO, este metodo es el punto de extension.
     */
    public function getAccessUrlAttribute(): ?string
    {
        return $this->moodle_url;
    }
}
