<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'grado',
        'seccion',
        'dni',
        'codigo_estudiante',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'sexo',
        'fecha_nacimiento',
        'edad'
    ];
}
