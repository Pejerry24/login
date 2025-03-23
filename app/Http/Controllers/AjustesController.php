<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AjustesController extends Controller
{
    // Método para mostrar el formulario de ajustes
    public function index()
    {
        return view('ajustes');
    }

    // Método para actualizar ajustes
    public function actualizar(Request $request)
    {
        // Validar solo los datos que irán a la base de datos
        $request->validate([
            'dni' => 'required|string|max:10|unique:users,dni,' . auth()->id(), // Asegurar que el DNI sea único excepto para el usuario actual
            'password' => 'nullable|string|min:8|confirmed', // Validar solo si se proporciona
        ]);

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Actualizar el campo DNI en la base de datos
        $user->dni = $request->dni;

        // Actualizar la contraseña si se proporcionó
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Guardar los cambios en la base de datos
        $user->save();

        // Actualizar el nombre y la imagen de forma local (sin base de datos)
        session([
            'nombre' => $request->nombre, // Guardar el nombre en la sesión
            'foto' => $request->hasFile('foto') ? $this->guardarFoto($request->file('foto')) : session('foto'), // Guardar la foto en la sesión
        ]);

        // Si se cambió la contraseña, cerrar sesión y reautenticar al usuario
        if ($request->password) {
            // Cerrar la sesión actual
            Auth::logout();

            // Reautenticar con el nuevo DNI y contraseña
            if (Auth::attempt(['dni' => $request->dni, 'password' => $request->password])) {
                // Si la autenticación es exitosa, redirigir a la página de ajustes
                return redirect()->route('ajustes')->with('success', 'Ajustes actualizados correctamente.');
            } else {
                // Si la autenticación falla, redirigir con un error
                return redirect()->route('login')->withErrors(['error' => 'La nueva contraseña no es válida.']);
            }
        }

        return redirect()->route('ajustes')->with('success', 'Ajustes actualizados correctamente.');
    }

    // Método para manejar la subida de la foto
    private function guardarFoto($foto)
    {
        $nombreArchivo = time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('images'), $nombreArchivo);
        return $nombreArchivo;
    }
}
