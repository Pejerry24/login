<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla asociada a este modelo
    protected $table = 'fichas_psicologicas_padres';

    // Especifica los campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'dni',
        'nombre',
        'parentesco',
        'ocupacion',
        'hijos',
        'domicilio',
        'estado_civil',
        'religion',
        'lugar_familia',
        'telefono',
        'nombre_estudiante',
        'fecha_nacimiento',
        'grado_seccion',
        'motivo_consulta',
        'antecedentes_relevantes',
        'intervencion_compromiso',
    ];
}