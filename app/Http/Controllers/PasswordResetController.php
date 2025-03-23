<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    // Método para verificar la palabra clave
    public function checkSecretWord(Request $request)
    {
        $user = User::where('email', $request->secret_word)->first(); // Asumiendo que la palabra clave está en el campo 'email'

        if ($user) {
            return response()->json(['status' => 'success', 'user_id' => $user->id]);
        }

        return response()->json(['status' => 'error', 'message' => 'Palabra clave incorrecta.']);
    }

    // Método para restablecer la contraseña
    public function resetPassword(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            // Verificar que la contraseña es válida (puedes agregar más validaciones aquí)
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Contraseña restablecida con éxito.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado.']);
    }
}
