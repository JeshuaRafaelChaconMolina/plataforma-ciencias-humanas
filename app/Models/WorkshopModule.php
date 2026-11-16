<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Módulo de un taller. Espejo de CourseModule, sin imagen
 * (la portada es la del taller, no la del módulo).
 */
class WorkshopModule extends Model
{
    protected $fillable = ['workshop_id', 'title', 'description', 'order'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function lessons()
    {
        return $this->morphMany(ModuleLesson::class, 'lessonable')->orderBy('order');
    }
}
