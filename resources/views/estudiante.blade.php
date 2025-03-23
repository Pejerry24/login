@extends('layouts.app')

@section('content')
<div class="estudiante-page container mt-4">
    <h1 class="mb-4 text-center text-primary">Listado de Alumnos</h1>

    <!-- Botón para abrir el modal de creación de estudiante -->
    <div class="mb-3 d-flex justify-content-end">
        <button class="btn btn-success shadow" data-bs-toggle="modal" data-bs-target="#createStudentModal">
            <i class="bi bi-person-plus"></i> Insertar Nuevo Estudiante
        </button>
    </div>

    <!-- Tabla de alumnos -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover shadow">
            <thead class="table-primary">
                <tr>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>DNI</th>
                    <th>Código del Estudiante</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>Sexo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->grado }}</td>
                    <td>{{ $alumno->seccion }}</td>
                    <td>{{ $alumno->dni }}</td>
                    <td>{{ $alumno->codigo_estudiante }}</td>
                    <td>{{ $alumno->apellido_paterno }}</td>
                    <td>{{ $alumno->apellido_materno }}</td>
                    <td>{{ $alumno->nombres }}</td>
                    <td>{{ $alumno->sexo }}</td>
                    <td>{{ $alumno->fecha_nacimiento }}</td>
                    <td>{{ $alumno->edad }}</td>
                    <td class="d-flex justify-content-start">
                        <button class="btn btn-warning btn-sm shadow" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $alumno->id }}">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button>
                        <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm shadow ms-2">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal de edición para cada alumno -->
                <div class="modal fade" id="editStudentModal{{ $alumno->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $alumno->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editStudentModalLabel{{ $alumno->id }}">Editar Estudiante</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @include('profile.partials.student-form', ['alumno' => $alumno])
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de creación de estudiante -->
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('alumnos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createStudentModalLabel">Insertar Nuevo Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('profile.partials.student-form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Estilos para la página específica de estudiantes */
        .estudiante-page {
            background-color: #e9ecef; /* Fondo gris suave */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .estudiante-page h1 {
            color: #007bff; /* Azul llamativo */
            text-transform: uppercase;
        }

        .estudiante-page .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .estudiante-page .table-hover tbody tr:hover {
            background-color: #e3f2fd;
        }

        .estudiante-page .table-primary {
            background-color: #007bff;
            color: white;
        }

        .estudiante-page .btn {
            border-radius: 5px;
            font-size: 14px;
        }

        .estudiante-page .btn-success:hover {
            background-color: #218838;
        }

        .estudiante-page .btn-warning:hover {
            background-color: #e0a800;
        }

        .estudiante-page .btn-danger:hover {
            background-color: #a71d2a;
        }
    </style>
@endpush
