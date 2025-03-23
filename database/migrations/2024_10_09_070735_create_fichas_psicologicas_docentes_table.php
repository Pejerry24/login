<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_fichas_psicologicas_docentes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasPsicologicasDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_psicologicas_docentes', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->string('docente_area');
            $table->integer('edad');
            $table->boolean('tutor'); // 1 para Sí, 0 para No
            $table->string('grado_seccion');
            $table->boolean('contratado'); // 1 para Sí, 0 para No
            $table->boolean('nombrado'); // 1 para Sí, 0 para No
            $table->enum('estado_civil', ['Conviviente', 'Casado', 'Separado']);
            $table->integer('hijos')->nullable();
            $table->string('domicilio');
            $table->string('telefono')->nullable();
            $table->string('estado_salud_fisico');
            $table->boolean('padecimiento_enfermedad_fisica'); // 1 para Sí, 0 para No
            $table->string('estado_salud_emocional');
            $table->boolean('padecimiento_enfermedad_emocional'); // 1 para Sí, 0 para No
            $table->text('motivo_consulta')->nullable();
            $table->text('antecedentes_relevantes')->nullable();
            $table->text('intervencion_compromiso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas_psicologicas_docentes');
    }
}
