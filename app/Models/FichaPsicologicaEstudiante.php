<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaPsicologicaEstudiante extends Model
{
    use HasFactory;

    // Especificas la tabla para este modelo
    protected $table = 'fichas_psicologicas_estudiantes';

    // Si no tienes timestamps (created_at y updated_at)
    public $timestamps = false;

    // Campos que puedes llenar
    protected $fillable = ['dni', 'nombre_apellido'];
}
