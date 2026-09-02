<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('fileable_type');
            $table->unsignedBigInteger('fileable_id');
            $table->string('original_name');
            $table->string('path');
            $table->string('disk')->default('public');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable(); // bytes
            $table->string('purpose')->nullable(); // cover | attachment | gallery, etc.
            $table->timestamps();

            $table->index(['fileable_type', 'fileable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
