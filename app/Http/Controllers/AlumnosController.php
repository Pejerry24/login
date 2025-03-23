<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnosController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return view('estudiante', compact('alumnos'));
    }

    public function create()
    {
        return view('alumnos.create'); // Cargar vista de creación de alumno
    }

    public function store(Request $request)
    {
        // Validar y crear un nuevo alumno
        $validatedData = $request->validate([
            'grado' => 'required|string',
            'seccion' => 'required|string',
            'dni' => 'required|string|unique:alumnos',
            'codigo_estudiante' => 'required|string|unique:alumnos',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'nombres' => 'required|string',
            'sexo' => 'required|in:Masculino,Femenino',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer',
        ]);

        Alumno::create($validatedData);
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado con éxito.');
    }

    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno')); // Cargar vista de edición de alumno
    }

    public function update(Request $request, Alumno $alumno)
    {
        // Validar y actualizar alumno
        $validatedData = $request->validate([
            'grado' => 'required|string',
            'seccion' => 'required|string',
            'dni' => 'required|string|unique:alumnos,dni,' . $alumno->id,
            'codigo_estudiante' => 'required|string|unique:alumnos,codigo_estudiante,' . $alumno->id,
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'nombres' => 'required|string',
            'sexo' => 'required|in:Masculino,Femenino',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer',
        ]);

        $alumno->update($validatedData);
        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado con éxito.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado con éxito.');
    }
}
