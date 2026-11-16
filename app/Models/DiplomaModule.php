<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Módulo de un diplomado. Espejo de CourseModule, sin imagen
 * (la portada es la del diplomado, no la del módulo).
 */
class DiplomaModule extends Model
{
    protected $fillable = ['diploma_id', 'title', 'description', 'order'];

    public function diploma()
    {
        return $this->belongsTo(Diploma::class);
    }

    public function lessons()
    {
        return $this->morphMany(ModuleLesson::class, 'lessonable')->orderBy('order');
    }
}
