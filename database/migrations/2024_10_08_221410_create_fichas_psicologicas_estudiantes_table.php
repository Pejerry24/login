<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fichas_psicologicas_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('dni');
            $table->string('nombre_apellido');
            $table->integer('edad');
            $table->string('grado_seccion');
            $table->string('tutor');
            $table->string('domicilio');
            $table->string('vive_con');
            $table->date('fecha_nacimiento');
            $table->string('lugar_procedencia');
            $table->string('religion');
            $table->text('derivacion');
            $table->text('motivo_consulta');
            $table->text('antecedentes_relevantes');
            $table->text('relacion_familiar');
            $table->text('intervencion_compromiso');
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas_psicologicas_estudiantes');
    }
};
