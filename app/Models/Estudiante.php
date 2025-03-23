<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'fichas_psicologicas_estudiantes';

    // Define aquí los campos que son asignables
    protected $fillable = [
        'fecha',
        'dni',
        'nombre_apellido',
        'edad',
        'grado_seccion',
        'tutor',
        'domicilio',
        'vive_con',
        'fecha_nacimiento',
        'lugar_procedencia',
        'religion',
        'derivacion',
        'motivo_consulta',
        'antecedentes_relevantes',
        'relacion_familiar',
        'intervencion_compromiso',
    ];
}

try {
    // Guarda los datos en la base de datos
    Estudiante::create($data);
    return response()->json(['success' => 'Registro guardado exitosamente']);
} catch (\Exception $e) {
    return response()->json(['error' => 'No se pudo guardar el registro: ' . $e->getMessage()]);
}