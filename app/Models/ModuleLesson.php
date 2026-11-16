<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Una lección es solo un título dentro de un módulo.
 *
 * Se guarda en tabla propia (no en un texto libre ni en JSON) porque
 * el usuario pidió una LISTA de lecciones por módulo: así cada lección
 * tiene su propio orden, se puede agregar/quitar una a una en el
 * formulario y se muestra como lista en la ficha pública.
 *
 * Relación polimórfica: el mismo modelo sirve para los módulos de
 * cursos (CourseModule), diplomados (DiplomaModule) y talleres
 * (WorkshopModule), sin triplicar tablas.
 */
class ModuleLesson extends Model
{
    protected $fillable = ['lessonable_type', 'lessonable_id', 'title', 'order'];

    public function lessonable()
    {
        return $this->morphTo();
    }
}
