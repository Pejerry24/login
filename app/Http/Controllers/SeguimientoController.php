<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FichaPsicologicaEstudiante;
use App\Models\FichaPsicologicaPadre;
use App\Models\FichaPsicologicaDocente;

class SeguimientoController extends Controller
{
    public function buscar(Request $request)
    {
        $dni = $request->input('dni');

        // Buscamos en las tres tablas por el DNI
        $fichasEstudiantes = FichaPsicologicaEstudiante::where('dni', $dni)->get();
        $fichasPadres = FichaPsicologicaPadre::where('dni', $dni)->get();
        $fichasDocentes = FichaPsicologicaDocente::where('dni', $dni)->get();

        // Si no se encuentran resultados en ninguna tabla
        if ($fichasEstudiantes->isEmpty() && $fichasPadres->isEmpty() && $fichasDocentes->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron fichas para este DNI.');
        }

        // Juntamos los resultados de las tres tablas
        $fichas = collect();

        // Para estudiantes
        foreach ($fichasEstudiantes as $ficha) {
            $fichas->push([
                'id' => $ficha->id,
                'dni' => $ficha->dni,
                'nombre' => $ficha->nombre_apellido,
                'tipo_ficha' => 'Estudiante',
            ]);
        }

        // Para padres
        foreach ($fichasPadres as $ficha) {
            $fichas->push([
                'id' => $ficha->id,
                'dni' => $ficha->dni,
                'nombre' => $ficha->nombre, // Para padres solo es 'nombre'
                'tipo_ficha' => 'Padre',
            ]);
        }

        // Para docentes
        foreach ($fichasDocentes as $ficha) {
            $fichas->push([
                'id' => $ficha->id,
                'dni' => $ficha->dni,
                'nombre' => $ficha->nombre, // Para docentes también es 'nombre'
                'tipo_ficha' => 'Docente',
            ]);
        }

        // Pasamos las fichas encontradas a la vista
        return view('seguimiento', compact('fichas', 'dni'));
    }

    public function eliminar($tipoFicha, $id)
    {
        // Eliminar la ficha según el tipo
        switch ($tipoFicha) {
            case 'estudiante':
                $ficha = FichaPsicologicaEstudiante::find($id);
                break;
            case 'padre':
                $ficha = FichaPsicologicaPadre::find($id);
                break;
            case 'docente':
                $ficha = FichaPsicologicaDocente::find($id);
                break;
            default:
                return redirect()->route('seguimiento.index')->with('error', 'Tipo de ficha no válido.');
        }

        if ($ficha) {
            $ficha->delete();
            return redirect()->route('seguimiento.index')->with('success', 'Ficha eliminada correctamente.');
        } else {
            return redirect()->route('seguimiento.index')->with('error', 'Ficha no encontrada.');
        }
    }

    public function ver($tipoFicha, $id)
    {
        if ($tipoFicha === 'estudiante') {
            $ficha = FichaPsicologicaEstudiante::findOrFail($id);
            return view('estudiante-ver', compact('ficha'));
        } elseif ($tipoFicha === 'padre') {
            $ficha = FichaPsicologicaPadre::findOrFail($id);
            return view('padre-ver', compact('ficha'));
        } elseif ($tipoFicha === 'docente') {
            $ficha = FichaPsicologicaDocente::findOrFail($id);
            return view('docente-ver', compact('ficha'));
        }
        
        return redirect()->route('seguimiento.index')->with('error', 'Tipo de ficha no válida.');
    }

    public function index()
    {
        return view('seguimiento');
    }
}
