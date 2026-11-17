<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Enlace con la cuenta de Moodle creada automáticamente al
        // registrarse en Laravel. Solo el nombre de usuario y el id de
        // Moodle: la contraseña nunca se guarda aquí, vive hasheada en
        // Laravel y en Moodle por separado.
        Schema::table('users', function (Blueprint $table) {
            $table->string('moodle_username')->nullable()->after('email');
            $table->unsignedBigInteger('moodle_user_id')->nullable()->after('moodle_username');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['moodle_username', 'moodle_user_id']);
        });
    }
};
