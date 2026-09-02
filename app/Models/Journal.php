<?php

namespace App\Models;

use App\Models\Concerns\HasPublicationLifecycle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory, HasPublicationLifecycle;

    protected $fillable = [
        'category_id', 'created_by', 'title', 'slug', 'description',
        'edition', 'year', 'metadata', 'status', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'published_at' => 'datetime',
        ];
    }
}
