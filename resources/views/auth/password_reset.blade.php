<form action="{{ route('password.recovery') }}" method="POST">
    @csrf
    <input type="text" name="email" placeholder="Introduce tu palabra clave" required>
    <button type="submit">Recuperar Contraseña</button>
</form>

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
