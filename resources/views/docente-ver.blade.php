@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ficha del Docente: {{ $ficha->nombre }}</h3>

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
                <th>Fecha de Nacimiento</th>
                <td>{{ $ficha->fecha_nacimiento }}</td>
            </tr>
            <tr>
                <th>Área del Docente</th>
                <td>{{ $ficha->docente_area }}</td>
            </tr>
            <tr>
                <th>Edad</th>
                <td>{{ $ficha->edad }}</td>
            </tr>
            <tr>
                <th>Tutor</th>
                <td>{{ $ficha->tutor }}</td>
            </tr>
            <tr>
                <th>Grado y Sección</th>
                <td>{{ $ficha->grado_seccion }}</td>
            </tr>
            <tr>
                <th>Contratado</th>
                <td>{{ $ficha->contratado }}</td>
            </tr>
            <tr>
                <th>Nombrado</th>
                <td>{{ $ficha->nombrado }}</td>
            </tr>
            <tr>
                <th>Estado Civil</th>
                <td>{{ $ficha->estado_civil }}</td>
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
                <th>Teléfono</th>
                <td>{{ $ficha->telefono }}</td>
            </tr>
            <tr>
                <th>Estado de Salud Físico</th>
                <td>{{ $ficha->estado_salud_fisico }}</td>
            </tr>
            <tr>
                <th>Padecimiento de Enfermedad Física</th>
                <td>{{ $ficha->padecimiento_enfermedad_fisica }}</td>
            </tr>
            <tr>
                <th>Estado de Salud Emocional</th>
                <td>{{ $ficha->estado_salud_emocional }}</td>
            </tr>
            <tr>
                <th>Padecimiento de Enfermedad Emocional</th>
                <td>{{ $ficha->padecimiento_enfermedad_emocional }}</td>
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
