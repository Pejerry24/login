<div class="mb-3">
    <label for="grado" class="form-label">Grado</label>
    <input type="text" class="form-control" name="grado" id="grado" value="{{ old('grado', $alumno->grado ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="seccion" class="form-label">Sección</label>
    <input type="text" class="form-control" name="seccion" id="seccion" value="{{ old('seccion', $alumno->seccion ?? '') }}" required>
</div>

<!-- Agrega los demás campos de forma similar -->
<div class="mb-3">
    <label for="dni" class="form-label">DNI</label>
    <input type="text" class="form-control" name="dni" id="dni" value="{{ old('dni', $alumno->dni ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="codigo_estudiante" class="form-label">Código del Estudiante</label>
    <input type="text" class="form-control" name="codigo_estudiante" id="codigo_estudiante" value="{{ old('codigo_estudiante', $alumno->codigo_estudiante ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
    <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" value="{{ old('apellido_paterno', $alumno->apellido_paterno ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="apellido_materno" class="form-label">Apellido Materno</label>
    <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" value="{{ old('apellido_materno', $alumno->apellido_materno ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="nombres" class="form-label">Nombres</label>
    <input type="text" class="form-control" name="nombres" id="nombres" value="{{ old('nombres', $alumno->nombres ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="sexo" class="form-label">Sexo</label>
    <select class="form-control" name="sexo" id="sexo" required>
        <option value="Masculino" {{ (old('sexo', $alumno->sexo ?? '') == 'Masculino') ? 'selected' : '' }}>Masculino</option>
        <option value="Femenino" {{ (old('sexo', $alumno->sexo ?? '') == 'Femenino') ? 'selected' : '' }}>Femenino</option>
    </select>
</div>

<div class="mb-3">
    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="edad" class="form-label">Edad</label>
    <input type="number" class="form-control" name="edad" id="edad" value="{{ old('edad', $alumno->edad ?? '') }}" required>
</div>
