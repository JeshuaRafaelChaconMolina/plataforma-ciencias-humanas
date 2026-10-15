<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleCourseLink extends Model
{
    protected $fillable = ['course_id', 'moodle_url', 'moodle_course_id', 'is_active'];

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

    /**
     * URL final a la que apunta el botón "INGRESAR AL CURSO".
     * Si en el futuro se define SSO, este metodo es el punto de extension.
     */
    public function getAccessUrlAttribute(): ?string
    {
        return $this->moodle_url;
    }
}
