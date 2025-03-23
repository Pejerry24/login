<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hacer la columna 'email' nullable antes de eliminarla
            $table->string('email')->nullable()->change();
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // En caso de rollback, agregar nuevamente el campo 'email' como nullable
            $table->string('email')->nullable();
        });
    }
};
