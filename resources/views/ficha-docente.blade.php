@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ficha Psicológica - Atención Docentes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('ficha.docente.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" class="form-control" name="dni" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" required>
        </div>
        <div class="mb-3">
            <label for="docente_area" class="form-label">Docente de Área</label>
            <input type="text" class="form-control" name="docente_area" required>
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control" name="edad" required>
        </div>
        <div class="mb-3">
            <label for="tutor" class="form-label">Tutor</label>
            <select class="form-control" name="tutor" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="grado_seccion" class="form-label">Grado y Sección</label>
            <input type="text" class="form-control" name="grado_seccion" required>
        </div>
        <div class="mb-3">
            <label for="contratado" class="form-label">Contratado</label>
            <select class="form-control" name="contratado" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nombrado" class="form-label">Nombrado</label>
            <select class="form-control" name="nombrado" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="estado_civil" class="form-label">Estado Civil</label>
            <select class="form-control" name="estado_civil" required>
                <option value="Conviviente">Conviviente</option>
                <option value="Casado">Casado</option>
                <option value="Separado">Separado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="hijos" class="form-label">¿Cuántos hijos tiene?</label>
            <input type="number" class="form-control" name="hijos">
        </div>
        <div class="mb-3">
            <label for="domicilio" class="form-label">Domicilio</label>
            <input type="text" class="form-control" name="domicilio" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono">
        </div>
        <div class="mb-3">
            <label for="estado_salud_fisico" class="form-label">Estado de salud físico</label>
            <input type="text" class="form-control" name="estado_salud_fisico" required>
        </div>
        <div class="mb-3">
            <label for="padecimiento_enfermedad_fisica" class="form-label">¿Padece alguna enfermedad física?</label>
            <select class="form-control" name="padecimiento_enfermedad_fisica" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="estado_salud_emocional" class="form-label">Estado de salud emocional</label>
            <input type="text" class="form-control" name="estado_salud_emocional" required>
        </div>
        <div class="mb-3">
            <label for="padecimiento_enfermedad_emocional" class="form-label">¿Padece alguna enfermedad emocional?</label>
            <select class="form-control" name="padecimiento_enfermedad_emocional" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="motivo_consulta" class="form-label">Motivo de Consulta</label>
            <textarea class="form-control" name="motivo_consulta" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="antecedentes_relevantes" class="form-label">Antecedentes Relevantes</label>
            <textarea class="form-control" name="antecedentes_relevantes" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="intervencion_compromiso" class="form-label">Intervención y Compromiso</label>
            <textarea class="form-control" name="intervencion_compromiso" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        recognition.lang = 'es-ES';
        recognition.interimResults = true; // Permite resultados intermedios
        recognition.maxAlternatives = 1; // Máximo de alternativas

        const statusMessage = document.getElementById('status-message');
        const startButton = document.getElementById('start-button');
        const stopButton = document.getElementById('stop-button');

        function startRecognition() {
            recognition.start();
            localStorage.setItem('voiceControlActive', 'true');
            statusMessage.textContent = 'Reconocimiento de voz activado. ¡Puedes hablar!';
            startButton.style.display = 'none'; // Oculta el botón de inicio
            stopButton.style.display = 'inline-block'; // Muestra el botón de detener
            speak('Hola, soy asistente virtual.'); // Saludo de voz al iniciar
        }

        function stopRecognition() {
            recognition.stop();
            localStorage.setItem('voiceControlActive', 'false');
            statusMessage.textContent = 'Reconocimiento de voz desactivado.';
            stopButton.style.display = 'none'; // Oculta el botón de detener
            startButton.style.display = 'inline-block'; // Muestra el botón de inicio
        }

        function speak(text) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'es-ES';
            window.speechSynthesis.speak(utterance);
        }

        function handleVoiceCommand(command) {
            console.log('Comando recibido:', command);
            
            if (command.includes('ajustes')) {
                window.location.href = '/ajustes';
                
            } else if (command.includes('inicio')) {
                window.location.href = '/inicio';

            } else if (command.includes('seguimiento')) {
                window.location.href = '/seguimiento';

            } else if (command.includes('ficha estudiante')) {
                window.location.href = '/ficha/estudiante';

            } else if (command.includes('ficha padre')) {
                window.location.href = '/ficha/padre-de-familia';

            } else if (command.includes('ficha docente')) {
                window.location.href = '/ficha/docente';

            } else if (command.includes('análisis de sentimiento')) {
                window.location.href = '/analisis/sentimiento';

            } else if (command.includes('desactivar')) {
                stopRecognition();

            } 
            // Comando para redirigir a la página de registro de nuevas citas
            else if (command.includes('cita') || command.includes('nueva cita')) {
                window.location.href = '/citas/nuevas';
            } 
            // Comando para redirigir a la página de "ver citas"
            else if (command.includes('agenda')) {
                window.location.href = '/citas/ver'; // Redirige a la página de ver citas
            } 
            else {
                if (statusMessage) {
                    statusMessage.textContent = 'No entendí el comando. Intenta de nuevo.';
                }
            }
        }

        recognition.onresult = function(event) {
            const command = event.results[0][0].transcript.toLowerCase();
            handleVoiceCommand(command);
        };

        recognition.onend = function() {
            if (localStorage.getItem('voiceControlActive') === 'true') {
                startRecognition(); // Reinicia el reconocimiento
            }
        };

        window.onload = function() {
            if (localStorage.getItem('voiceControlActive') === 'true') {
                startRecognition(); // Inicia el reconocimiento si estaba activo
            }
        };

        // Eventos de los botones
        startButton.addEventListener('click', startRecognition);
        stopButton.addEventListener('click', stopRecognition);
    </script>
@endsection
