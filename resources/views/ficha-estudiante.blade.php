@extends('layouts.app')

@section('content')
<div class="custom-container py-5">
    <div class="custom-card shadow-lg p-5">
        <h2 class="text-center mb-4 custom-title">Ficha Psicológica para Estudiantes</h2>

        <!-- Notificaciones de éxito y error -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('ficha.estudiante.submit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control custom-input" name="fecha" required>
                    <div class="invalid-feedback">Por favor ingrese la fecha.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control custom-input" name="dni" id="dni" required>
                    <div class="invalid-feedback">Por favor ingrese el DNI.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre_apellido" class="form-label">Nombre y Apellido</label>
                    <input type="text" class="form-control custom-input" name="nombre_apellido" id="nombre_apellido" readonly>
                    <div class="invalid-feedback">Por favor ingrese el nombre completo.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control custom-input" name="edad" id="edad" readonly>
                    <div class="invalid-feedback">Por favor ingrese la edad.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="grado_seccion" class="form-label">Grado y Sección</label>
                    <input type="text" class="form-control custom-input" name="grado_seccion" id="grado_seccion" readonly>
                    <div class="invalid-feedback">Por favor ingrese el grado y sección.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tutor" class="form-label">Tutor</label>
                    <input type="text" class="form-control custom-input" name="tutor" required>
                    <div class="invalid-feedback">Por favor ingrese el nombre del tutor.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input type="text" class="form-control custom-input" name="domicilio" required>
                    <div class="invalid-feedback">Por favor ingrese el domicilio.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="vive_con" class="form-label">Vives con</label>
                    <input type="text" class="form-control custom-input" name="vive_con" required>
                    <div class="invalid-feedback">Por favor indique con quién vive el estudiante.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control custom-input" name="fecha_nacimiento" id="fecha_nacimiento" readonly>
                    <div class="invalid-feedback">Por favor ingrese la fecha de nacimiento.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lugar_procedencia" class="form-label">Lugar de Procedencia</label>
                    <input type="text" class="form-control custom-input" name="lugar_procedencia" required>
                    <div class="invalid-feedback">Por favor ingrese el lugar de procedencia.</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="religion" class="form-label">Religión</label>
                    <input type="text" class="form-control custom-input" name="religion">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="derivacion" class="form-label">Derivación</label>
                    <input type="text" class="form-control custom-input" name="derivacion">
                </div>
            </div>

            <div class="mb-3">
                <label for="motivo_consulta" class="form-label">Motivo de Consulta</label>
                <input type="text" class="form-control custom-input" name="motivo_consulta">
            </div>

            <div class="mb-3">
                <label for="antecedentes_relevantes" class="form-label">Antecedentes Relevantes</label>
                <input type="text" class="form-control custom-input" name="antecedentes_relevantes">
            </div>

            <div class="mb-3">
                <label for="relacion_familiar" class="form-label">Relación Familiar</label>
                <input type="text" class="form-control custom-input" name="relacion_familiar">
            </div>

            <div class="mb-3">
                <label for="intervencion_compromiso" class="form-label">Intervención y Compromiso</label>
                <input type="text" class="form-control custom-input" name="intervencion_compromiso">
            </div>

            <div class="text-center">
                <button type="submit" class="btn custom-btn btn-lg px-5">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Script para autocompletar los campos basados en el DNI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('blur', '#dni', function () {
        let dni = $(this).val();

        if (dni) {
            $.ajax({
                url: '/ficha/buscar-alumno/' + dni,
                type: 'GET',
                success: function (data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Rellenar los campos del formulario con los datos del alumno
                        $('#nombre_apellido').val(data.nombre_apellido);
                        $('#edad').val(data.edad);
                        $('#grado_seccion').val(data.grado_seccion);
                        $('#fecha_nacimiento').val(data.fecha_nacimiento);
                    }
                },
                error: function () {
                    alert('No se pudo obtener los datos del alumno. Verifica el DNI.');
                }
            });
        }
    });
</script>
<style>
    /* Estilos para la ficha psicológica */
.custom-container {
    background-color: #f8f9fa; /* Fondo gris claro */
    padding: 40px 0;
}

.custom-card {
    background-color: #ffffff; /* Fondo blanco */
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.custom-title {
    color: #007bff; /* Color azul para el título */
    text-transform: uppercase;
    font-weight: bold;
}

.custom-input {
    border-radius: 8px;
    font-size: 16px;
}

.custom-input:focus {
    border-color: #007bff; /* Cambio de color de borde al enfocar */
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Sombra azul al enfocar */
}

.custom-btn {
    background-color: #28a745; /* Fondo verde */
    color: white;
    border-radius: 50px;
    font-size: 18px;
    padding: 12px 30px;
    transition: background-color 0.3s ease;
}

.custom-btn:hover {
    background-color: #218838; /* Fondo verde oscuro al pasar el ratón */
}

.custom-btn:focus {
    outline: none;
    box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.5);
}

.form-label {
    font-size: 16px;
    font-weight: bold;
    color: #495057; /* Color gris oscuro */
}

.alert {
    font-size: 16px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

.invalid-feedback {
    font-size: 14px;
    color: #dc3545; /* Rojo para los mensajes de error */
}

/* Estilos para los campos de entrada */
input.form-control {
    font-size: 16px;
    padding: 10px;
    border-radius: 8px;
}

input.form-control:disabled {
    background-color: #e9ecef; /* Fondo gris claro para los campos deshabilitados */
}

/* Estilos para el formulario */
.form-row {
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .custom-container {
        padding: 20px;
    }
    .custom-card {
        padding: 20px;
    }
}

</style>
@endsection
