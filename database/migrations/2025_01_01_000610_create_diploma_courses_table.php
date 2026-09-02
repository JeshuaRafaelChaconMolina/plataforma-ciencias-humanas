<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla pivote preparada para que, en una fase posterior, un diplomado
        // pueda componerse de varios cursos. No se implementa logica de
        // composicion en Fase 1, solo se deja el esquema listo.
        Schema::create('diploma_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diploma_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->unique(['diploma_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diploma_courses');
    }
};
