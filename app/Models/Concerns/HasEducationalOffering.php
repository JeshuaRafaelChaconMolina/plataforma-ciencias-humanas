<?php

namespace App\Models\Concerns;

use App\Models\Category;
use App\Models\User;

/**
 * Trait compartido por Course, Diploma, Workshop.
 * Cubre los campos generales acordados: titulo, descripcion, proposito,
 * imagen, duracion, modalidad, categoria, estado y fechas.
 * Cada modelo conserva su propia tabla y sus relaciones especificas.
 */
trait HasEducationalOffering
{
    protected static function bootHasEducationalOffering(): void
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::slug($model->title) . '-' . \Illuminate\Support\Str::random(6);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files()
    {
        return $this->morphMany(\App\Models\FileAttachment::class, 'fileable');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
