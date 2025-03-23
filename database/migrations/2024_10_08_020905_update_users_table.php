<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina las columnas innecesarias
            $table->dropColumn(['name', 'email']); // Ajusta esto según tu estructura
            // Puedes agregar otras columnas si es necesario
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Aquí puedes revertir los cambios
            $table->string('name');
            $table->string('email')->unique();
        });
    }
}
