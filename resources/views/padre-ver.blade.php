@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ficha del Padre de Familia: {{ $ficha->nombre }}</h3>

    <table class="table">
        <tbody>
            <tr>
                <th>DNI</th>
                <td>{{ $ficha->dni }}</td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td>{{ $ficha->nombre }}</td>
            </tr>
            <tr>
                <th>Parentesco</th>
                <td>{{ $ficha->parentesco }}</td>
            </tr>
            <tr>
                <th>Ocupación</th>
                <td>{{ $ficha->ocupacion }}</td>
            </tr>
            <tr>
                <th>Hijos</th>
                <td>{{ $ficha->hijos }}</td>
            </tr>
            <tr>
                <th>Domicilio</th>
                <td>{{ $ficha->domicilio }}</td>
            </tr>
            <tr>
                <th>Estado Civil</th>
                <td>{{ $ficha->estado_civil }}</td>
            </tr>
            <tr>
                <th>Religión</th>
                <td>{{ $ficha->religion }}</td>
            </tr>
            <tr>
                <th>Lugar de la Familia</th>
                <td>{{ $ficha->lugar_familia }}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{ $ficha->telefono }}</td>
            </tr>
            <tr>
                <th>Nombre del Estudiante</th>
                <td>{{ $ficha->nombre_estudiante }}</td>
            </tr>
            <tr>
                <th>Fecha de Nacimiento</th>
                <td>{{ $ficha->fecha_nacimiento }}</td>
            </tr>
            <tr>
                <th>Grado y Sección</th>
                <td>{{ $ficha->grado_seccion }}</td>
            </tr>
            <tr>
                <th>Motivo de Consulta</th>
                <td>{{ $ficha->motivo_consulta }}</td>
            </tr>
            <tr>
                <th>Antecedentes Relevantes</th>
                <td>{{ $ficha->antecedentes_relevantes }}</td>
            </tr>
            <tr>
                <th>Intervención/Compromiso</th>
                <td>{{ $ficha->intervencion_compromiso }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('seguimiento.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
