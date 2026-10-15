<?php

namespace App\Models;

use App\Models\Concerns\HasEducationalOffering;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory, HasEducationalOffering;

    // Estructura independiente: sin módulos ni Moodle, tal como se acordo.
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
}
