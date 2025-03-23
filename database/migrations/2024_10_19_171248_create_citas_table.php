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
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->string('nombre');
        $table->string('motivo');
        $table->timestamps();
    });
 }
};