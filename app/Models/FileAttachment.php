<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FileAttachment extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'fileable_type', 'fileable_id', 'original_name',
        'path', 'disk', 'mime_type', 'size', 'purpose',
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
