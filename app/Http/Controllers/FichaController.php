<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\Padre;
use App\Models\Docente;

    class FichaController extends Controller
    {
        // Método para mostrar la vista del formulario de estudiantes
        public function showEstudiante()
        {
            // Devuelve la vista del formulario de ficha psicológica para estudiantes
            return view('ficha-estudiante');
        }

        // Método para manejar el envío del formulario de estudiantes
        public function submitEstudiante(Request $request)
        {
            $data = $request->validate([
                'fecha' => 'required|date',
                'dni' => 'required|string|max:10',
                'nombre_apellido' => 'required|string|max:255',
                'edad' => 'required|integer',
                'grado_seccion' => 'required|string|max:255',
                'tutor' => 'required|string|max:255',
                'domicilio' => 'required|string|max:255',
                'vive_con' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'lugar_procedencia' => 'required|string|max:255',
                'religion' => 'nullable|string|max:255',
                'derivacion' => 'nullable|string',
                'motivo_consulta' => 'nullable|string',
                'antecedentes_relevantes' => 'nullable|string',
                'relacion_familiar' => 'nullable|string',
                'intervencion_compromiso' => 'nullable|string',
            ]);

            try {
                // Guarda los datos en la base de datos
                Estudiante::create($data);
                return redirect()->route('ficha.estudiante')->with('success', 'Ficha guardada correctamente');
            } catch (\Exception $e) {
                // Manejo de errores
                return redirect()->route('ficha.estudiante')->with('error', 'Error al guardar la ficha: ' . $e->getMessage());
            }
        }
        public function buscarAlumnoPorDni($dni)
        {
            // Buscar al alumno en la tabla alumnos
            $alumno = \App\Models\Alumno::where('dni', $dni)->first();
        
            if ($alumno) {
                return response()->json([
                    'dni' => $alumno->dni,
                    'nombre_apellido' => $alumno->apellido_paterno . ' ' . $alumno->apellido_materno . ', ' . $alumno->nombres,
                    'edad' => $alumno->edad,
                    'grado_seccion' => $alumno->grado . ' ' . $alumno->seccion,
                    'fecha_nacimiento' => $alumno->fecha_nacimiento,
                ]);
            }
        
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }
        
    // Mostrar la ficha de padres de familia
    public function showPadre()
    {
        return view('ficha-padre-de-familia'); // Asegúrate de que este archivo exista en resources/views
    }

    // Guardar Ficha para Padres de Familia
    public function submitPadre(Request $request)
    {
        // Valida los datos del formulario
        $data = $request->validate([
            'dni' => 'required|string|max:15',
            'nombre' => 'required|string|max:255',
            'parentesco' => 'required|string|max:255',
            'ocupacion' => 'required|string|max:255',
            'hijos' => 'required|integer|min:0',
            'domicilio' => 'required|string|max:255',
            'estado_civil' => 'required|string|in:Conviviente,Casado,Separado',
            'religion' => 'nullable|string|max:255',
            'lugar_familia' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'nombre_estudiante' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'grado_seccion' => 'required|string|max:255',
            'motivo_consulta' => 'nullable|string',
            'antecedentes_relevantes' => 'nullable|string',
            'intervencion_compromiso' => 'nullable|string',
        ]);

        try {
            // Guarda los datos en la base de datos
            Padre::create($data);
            return redirect()->route('ficha.padre')->with('success', 'Ficha enviada con éxito');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('ficha.padre')->with('error', 'Error al enviar la ficha: ' . $e->getMessage());
        }
    }


    // Mostrar la ficha de docentes
    public function showDocente()
    {
        return view('ficha-docente'); // Asegúrate de que este archivo exista en resources/views
    }

    // Guardar Ficha para Docentes
    public function submitDocente(Request $request)
    {
        $data = $request->validate([
            'dni' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'docente_area' => 'required|string|max:100',
            'edad' => 'required|integer',
            'tutor' => 'required|boolean',
            'grado_seccion' => 'required|string|max:100',
            'contratado' => 'required|boolean',
            'nombrado' => 'required|boolean',
            'estado_civil' => 'required|string|in:Conviviente,Casado,Separado',
            'hijos' => 'nullable|integer',
            'domicilio' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'estado_salud_fisico' => 'required|string|max:100',
            'padecimiento_enfermedad_fisica' => 'required|boolean',
            'estado_salud_emocional' => 'required|string|max:100',
            'padecimiento_enfermedad_emocional' => 'required|boolean',
            'motivo_consulta' => 'nullable|string|max:255',
            'antecedentes_relevantes' => 'nullable|string|max:255',
            'intervencion_compromiso' => 'nullable|string|max:255',
        ]);

        try {
            Docente::create($data);
            return redirect()->route('ficha.docente')->with('success', 'Registro guardado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('ficha.docente')->with('error', 'No se pudo guardar el registro: ' . $e->getMessage());
        }
    }
}