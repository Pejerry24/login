<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnalisisSentimientoController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\AlumnosController;

// Ruta principal que redirige a la página de inicio de sesión
Route::get('/', function () {
    return redirect('/login');
});

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return redirect('/sistema-psicologia');
})->middleware(['auth'])->name('dashboard');

// Ruta para mostrar las estadísticas (Inicio)
Route::get('/inicio', [InicioController::class, 'index'])->middleware('auth')->name('inicio');

// Ruta para el sistema de psicología
Route::get('/sistema-psicologia', [InicioController::class, 'index'])->middleware('auth')->name('sistema.psicologia');

// Rutas para las fichas psicológicas
Route::prefix('ficha')->middleware('auth')->group(function () {
    Route::get('/estudiante', [FichaController::class, 'showEstudiante'])->name('ficha.estudiante');
    Route::post('/estudiante/submit', [FichaController::class, 'submitEstudiante'])->name('ficha.estudiante.submit');

    Route::get('/padre-de-familia', [FichaController::class, 'showPadre'])->name('ficha.padre');
    Route::post('/padre-de-familia/submit', [FichaController::class, 'submitPadre'])->name('ficha.padre.submit');

    Route::get('/docente', [FichaController::class, 'showDocente'])->name('ficha.docente');
    Route::post('/docente/submit', [FichaController::class, 'submitDocente'])->name('ficha.docente.submit');

    Route::get('/{tipoFicha}/{id}/ver', [SeguimientoController::class, 'ver'])->name('ficha.ver');
    Route::delete('/{tipoFicha}/{id}/eliminar', [SeguimientoController::class, 'eliminar'])->name('ficha.eliminar');
});

// Rutas para el perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta para mostrar la vista de seguimiento
Route::get('/seguimiento', [SeguimientoController::class, 'index'])->middleware('auth')->name('seguimiento.index');

// Ruta para buscar en Seguimiento
Route::get('/seguimiento/buscar', [SeguimientoController::class, 'buscar'])->middleware('auth')->name('seguimiento.buscar');

Route::get('/analisis-sentimiento', [AnalisisSentimientoController::class, 'mostrarFormulario'])->name('analisis.sentimiento');
Route::post('/analizar-sentimiento', [AnalisisSentimientoController::class, 'analizarSentimiento']);

Route::get('/voz', function () {
    return view('voz');
})->name('voz');

Route::get('/citas/nuevas', [CitasController::class, 'crear'])->name('citas.nuevas'); // Para crear nuevas citas
Route::post('/citas/guardar', [CitasController::class, 'guardar'])->name('citas.guardar'); // Para guardar una nueva cita
Route::get('/citas/ver', [CitasController::class, 'ver'])->name('citas.ver'); // Para ver todas las citas
Route::put('/citas/{id}/marcar', [CitasController::class, 'actualizarAtendida'])->name('citas.marcar');
Route::delete('/citas/{id}', [CitasController::class, 'eliminar'])->name('citas.eliminar'); // Para eliminar una cita
// Ruta para mostrar el formulario de ajustes
Route::get('/ajustes', [AjustesController::class, 'index'])->name('ajustes');

// Ruta para actualizar los ajustes
Route::post('/ajustes/actualizar', [AjustesController::class, 'actualizar'])->name('ajustes.actualizar');



Route::get('/alumnos', [AlumnosController::class, 'index'])->name('alumnos.index');
Route::get('/alumnos/create', [AlumnosController::class, 'create'])->name('alumnos.create');  // Formulario de creación de alumno
Route::post('/alumnos', [AlumnosController::class, 'store'])->name('alumnos.store');          // Guardar nuevo alumno
Route::get('/alumnos/{alumno}/edit', [AlumnosController::class, 'edit'])->name('alumnos.edit'); // Formulario de edición de alumno
Route::put('/alumnos/{alumno}', [AlumnosController::class, 'update'])->name('alumnos.update'); // Actualizar alumno
Route::delete('/alumnos/{alumno}', [AlumnosController::class, 'destroy'])->name('alumnos.destroy'); // Eliminar alumno

Route::get('/ficha/buscar-alumno/{dni}', [FichaController::class, 'buscarAlumnoPorDni'])->name('ficha.buscarAlumno');
