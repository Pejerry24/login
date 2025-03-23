<?php

// app/Models/Docente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'fichas_psicologicas_docentes';

    // Define aquí los campos que son asignables
    protected $fillable = [
        'dni',
        'nombre',
        'fecha_nacimiento',
        'docente_area',
        'edad',
        'tutor',
        'grado_seccion',
        'contratado',
        'nombrado',
        'estado_civil',
        'hijos',
        'domicilio',
        'telefono',
        'estado_salud_fisico',
        'padecimiento_enfermedad_fisica',
        'estado_salud_emocional',
        'padecimiento_enfermedad_emocional',
        'motivo_consulta',
        'antecedentes_relevantes',
        'intervencion_compromiso',
    ];
}
