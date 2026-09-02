<?php

namespace App\Models;

use App\Models\Concerns\HasEducationalOffering;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
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

    /**
     * Tabla pivote ya disponible (diploma_courses). La logica de composicion
     * (mostrar el diplomado como conjunto de cursos) se activa en una fase
     * posterior, segun lo acordado con el equipo.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'diploma_courses')->withPivot('order')->withTimestamps();
    }
}
