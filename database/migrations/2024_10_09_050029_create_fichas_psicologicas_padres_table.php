<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasPsicologicasPadresTable extends Migration
{
    public function up()
    {
        Schema::create('fichas_psicologicas_padres', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 15);
            $table->string('nombre', 255);
            $table->string('parentesco', 255);
            $table->string('ocupacion', 255);
            $table->integer('hijos');
            $table->string('domicilio', 255);
            $table->enum('estado_civil', ['Conviviente', 'Casado', 'Separado']);
            $table->string('religion', 255)->nullable();
            $table->string('lugar_familia', 255)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('nombre_estudiante', 255);
            $table->date('fecha_nacimiento');
            $table->string('grado_seccion', 255);
            $table->text('motivo_consulta')->nullable();
            $table->text('antecedentes_relevantes')->nullable();
            $table->text('intervencion_compromiso')->nullable();
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('fichas_psicologicas_padres');
    }
}
