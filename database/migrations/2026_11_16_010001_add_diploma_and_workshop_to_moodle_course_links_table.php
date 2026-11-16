<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('moodle_course_links', function (Blueprint $table) {
            // Un enlace de Moodle ahora puede ser de un curso, de un
            // diplomado o de un taller. Solo una de las tres columnas
            // tiene valor en cada fila. No se crea una tabla nueva para
            // no duplicar MoodleCourseLink ni tocar el enlace que ya
            // funciona en los cursos (Curso de Prueba, id de Moodle 2).
            $table->foreignId('diploma_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('workshop_id')->nullable()->constrained()->nullOnDelete();
            $table->unique('diploma_id');
            $table->unique('workshop_id');
        });

        // course_id pasa a admitir NULL (antes era obligatorio) porque
        // las filas de diplomados y talleres no tienen curso.
        // Se usa SQL directo y no ->change() porque doctrine/dbal no
        // está en composer.json. Base de datos del proyecto: PostgreSQL.
        DB::statement('ALTER TABLE moodle_course_links ALTER COLUMN course_id DROP NOT NULL');
    }

    public function down(): void
    {
        // Al revertir se pierden los enlaces de diplomados y talleres
        // (sus filas no tienen course_id).
        DB::statement("DELETE FROM moodle_course_links WHERE course_id IS NULL");

        Schema::table('moodle_course_links', function (Blueprint $table) {
            $table->dropUnique(['diploma_id']);
            $table->dropUnique(['workshop_id']);
            $table->dropForeign(['diploma_id']);
            $table->dropForeign(['workshop_id']);
            $table->dropColumn(['diploma_id', 'workshop_id']);
        });

        DB::statement('ALTER TABLE moodle_course_links ALTER COLUMN course_id SET NOT NULL');
    }
};
