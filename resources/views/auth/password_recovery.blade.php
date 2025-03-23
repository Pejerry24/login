@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Recuperación y Cambio de Contraseña</h2>

        <form action="{{ route('password.recovery') }}" method="POST">
            @csrf
            <div>
                <label for="secret_word">Introduce tu palabra clave</label>
                <input type="text" name="secret_word" placeholder="Introduce tu palabra clave" required>
            </div>

            @if (session('user_id'))
                <!-- Si el usuario es encontrado, muestra el formulario para cambiar la contraseña -->
                <div>
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" name="password" required>
                </div>

                <div>
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit">Restablecer Contraseña</button>
            @else
                <button type="submit">Buscar Usuario</button>
            @endif
        </form>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
@endsection
