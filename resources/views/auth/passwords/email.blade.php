@extends('layouts.user')

@section('title', 'Restablecer Contraseña')

@section('content')
<h2>Restablecer Contraseña</h2>
<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <div>
        <input type="email" name="email" placeholder="Correo Electrónico" required>
    </div>
    <div>
        <button type="submit">Enviar Enlace de Restablecimiento</button>
    </div>
</form>
@endsection
