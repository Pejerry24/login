<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordRecoveryController extends Controller
{
    // Mostrar el formulario de recuperación de la contraseña
    public function showForm(Request $request)
    {
        return view('auth.password_recovery');
    }

    // Procesar la recuperación de la contraseña con la palabra clave
    public function recoverPassword(Request $request)
    {
        // Validar que la palabra clave esté en la base de datos
        $request->validate([
            'secret_word' => 'required|exists:users,email',  // Verifica que la palabra clave exista en el campo email
        ]);

        try {
            // Obtener el usuario con la palabra clave
            $user = User::where('email', $request->secret_word)->first();

            if ($user) {
                // Almacenar el ID del usuario en la sesión
                session(['user_id' => $user->id]);

                // Redirigir a la misma página para mostrar el formulario de cambio de contraseña
                return redirect()->route('password.recovery.form')->with('user_id', $user->id);
            } else {
                return redirect()->route('password.recovery.form')->with('error', 'La palabra clave es incorrecta.');
            }
        } catch (\Exception $e) {
            return redirect()->route('password.recovery.form')->with('error', 'Hubo un problema al verificar la palabra clave.');
        }
    }

    // Procesar el restablecimiento de la contraseña
    public function resetPassword(Request $request)
    {
        // Validar las contraseñas
        $request->validate([
            'password' => 'required|min:8|confirmed',  // Contraseña mínima de 8 caracteres
        ]);

        try {
            // Obtener el usuario por el ID almacenado en la sesión
            $user = User::find(session('user_id'));

            if ($user) {
                // Actualizar la contraseña del usuario
                $user->password = Hash::make($request->password);
                $user->save();

                // Limpiar la sesión
                session()->forget('user_id');

                return redirect()->route('password.recovery.form')->with('success', 'Contraseña restablecida correctamente.');
            } else {
                return redirect()->route('password.recovery.form')->with('error', 'Usuario no encontrado.');
            }
        } catch (\Exception $e) {
            return redirect()->route('password.recovery.form')->with('error', 'Ocurrió un error al restablecer la contraseña.');
        }
    }

    // Verificar la palabra clave mediante AJAX
    public function checkSecretWord(Request $request)
    {
        $user = User::where('email', $request->secret_word)->first();

        if ($user) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
