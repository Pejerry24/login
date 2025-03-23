<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('layouts.user'); // Asegúrate de que la ruta sea correcta
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->validate([
            'dni' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt($credentials)) {
            // Redirigir al sistema de psicología si la autenticación es exitosa
            return redirect()->intended('/sistema-psicologia'); // Cambia '/sistema-psicologia' por tu ruta deseada
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'dni' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('dni')); // Retorna el DNI ingresado
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Redirige a la página de inicio
    }

    // Opcional: Si deseas personalizar la redirección después del inicio de sesión
    protected function authenticated(Request $request, $user)
    {
        // Puedes agregar lógica adicional aquí si es necesario
    }
}
