<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Módulos de diplomados: espejo de course_modules (título,
        // descripción, orden). Sin campo de imagen: la portada es la
        // del diplomado, no la de cada módulo.
        Schema::create('diploma_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diploma_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        // Módulos de talleres: mismo espejo de course_modules.
        Schema::create('workshop_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        // Lecciones: lista de títulos dentro de un módulo.
        // Polimórfica para no triplicar la tabla en cursos, diplomados
        // y talleres. Al borrar un módulo hay que borrar sus lecciones
        // desde el Form (la relación polimórfica no tiene FK en cascada).
        Schema::create('module_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lessonable_type');
            $table->unsignedBigInteger('lessonable_id');
            $table->string('title');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->index(['lessonable_type', 'lessonable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_lessons');
        Schema::dropIfExists('workshop_modules');
        Schema::dropIfExists('diploma_modules');
    }
};
