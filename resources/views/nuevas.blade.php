@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Cita</h1>
    
    <form action="{{ route('citas.guardar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cita</button>
    </form>
</div>
@endsection
