<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitasController extends Controller
{
    // Mostrar el formulario para crear una nueva cita
    public function crear()
    {
        return view('citas.nuevas');
    }

    // Ver todas las citas
    public function ver()
    {
        // Obtener todas las citas ordenadas por fecha
        $citas = Cita::orderBy('fecha', 'asc')->get(); // Ordena por fecha
        return view('citas.ver', compact('citas'));
    }

    // Guardar una nueva cita
    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:255',
            'motivo' => 'required|string|max:500',
        ]);

        try {
            // Crear la cita
            Cita::create([
                'fecha' => $request->fecha,
                'nombre' => $request->nombre,
                'motivo' => $request->motivo,
            ]);

            return redirect()->route('citas.ver')->with('success', 'Cita guardada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('citas.crear')->with('error', 'Ocurrió un error al guardar la cita: ' . $e->getMessage());
        }
    }

    // Eliminar una cita
    public function eliminar($id)
    {
        try {
            $cita = Cita::findOrFail($id); // Busca la cita
            $cita->delete(); // Elimina la cita

            return redirect()->route('citas.ver')->with('success', 'Cita eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('citas.ver')->with('error', 'No se pudo eliminar la cita: ' . $e->getMessage());
        }
    }

    // Marcar una cita como atendida o no atendida
    public function actualizarAtendida(Request $request, $id)
    {
        try {
            $cita = Cita::findOrFail($id); // Busca la cita
            $cita->atendida = $request->atendida; // Cambia el estado de atendida
            $cita->save(); // Guarda el nuevo estado

            return redirect()->route('citas.ver')->with('success', 'Estado de la cita actualizado.');
        } catch (\Exception $e) {
            return redirect()->route('citas.ver')->with('error', 'No se pudo actualizar el estado de la cita: ' . $e->getMessage());
        }
    }

    // Método para manejar la impresión
    public function imprimir()
    {
        // Si deseas pasar más lógica al imprimir, puedes hacerlo aquí
        try {
            $citas = Cita::orderBy('fecha', 'asc')->get(); // Obtener todas las citas
            return view('citas.imprimir', compact('citas')); // Muestra la vista para imprimir
        } catch (\Exception $e) {
            return redirect()->route('citas.ver')->with('error', 'No se pudo generar la vista de impresión: ' . $e->getMessage());
        }
    }
}
