<?php

namespace App\Http\Controllers;

use App\Models\Padre;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Cita; // Asegúrate de que el modelo Cita esté importado
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index()
    {
        // Datos semanales
        $fichasSemanales['estudiantes'] = Estudiante::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $fichasSemanales['padres'] = Padre::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $fichasSemanales['docentes'] = Docente::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $fichasSemanales['total'] = $fichasSemanales['estudiantes'] + $fichasSemanales['padres'] + $fichasSemanales['docentes'];

        // Datos mensuales
        $fichasMensuales['estudiantes'] = Estudiante::whereMonth('created_at', Carbon::now()->month)->count();
        $fichasMensuales['padres'] = Padre::whereMonth('created_at', Carbon::now()->month)->count();
        $fichasMensuales['docentes'] = Docente::whereMonth('created_at', Carbon::now()->month)->count();
        $fichasMensuales['total'] = $fichasMensuales['estudiantes'] + $fichasMensuales['padres'] + $fichasMensuales['docentes'];

        // Datos anuales
        $fichasAnuales['estudiantes'] = Estudiante::whereYear('created_at', Carbon::now()->year)->count();
        $fichasAnuales['padres'] = Padre::whereYear('created_at', Carbon::now()->year)->count();
        $fichasAnuales['docentes'] = Docente::whereYear('created_at', Carbon::now()->year)->count();
        $fichasAnuales['total'] = $fichasAnuales['estudiantes'] + $fichasAnuales['padres'] + $fichasAnuales['docentes'];

        // Obtener citas programadas para hoy
        $citasHoy = Cita::whereDate('fecha', Carbon::today())->get(); // Verifica que el campo se llama 'fecha'

        // Pasar los datos a la vista
        return view('inicio', compact('fichasSemanales', 'fichasMensuales', 'fichasAnuales', 'citasHoy'));
    }
}
