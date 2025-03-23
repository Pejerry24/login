@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>FICHA PSICOLÓGICA - ATENCIÓN PADRES DE FAMILIA</h2>

        <!-- Notificaciones de éxito y error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

        
        <form action="{{ route('ficha.padre.submit') }}" method="POST">
            @csrf
            
            <h5>I. Datos Generales</h5>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="parentesco" class="form-label">Parentesco:</label>
                <input type="text" class="form-control" id="parentesco" name="parentesco" required>
            </div>
            <div class="mb-3">
                <label for="ocupacion" class="form-label">Ocupación:</label>
                <input type="text" class="form-control" id="ocupacion" name="ocupacion" required>
            </div>
            <div class="mb-3">
                <label for="hijos" class="form-label">¿Cuántos hijos tiene?:</label>
                <input type="number" class="form-control" id="hijos" name="hijos" required>
            </div>
            <div class="mb-3">
                <label for="domicilio" class="form-label">Domicilio:</label>
                <input type="text" class="form-control" id="domicilio" name="domicilio" required>
            </div>
            <div class="mb-3">
                <label for="estado_civil" class="form-label">Estado Civil:</label>
                <select class="form-select" id="estado_civil" name="estado_civil" required>
                    <option value="Conviviente">Conviviente</option>
                    <option value="Casado">Casado</option>
                    <option value="Separado">Separado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="religion" class="form-label">Religión:</label>
                <input type="text" class="form-control" id="religion" name="religion">
            </div>
            <div class="mb-3">
                <label for="lugar_familia" class="form-label">Lugar que ocupa en la familia:</label>
                <input type="text" class="form-control" id="lugar_familia" name="lugar_familia">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>

            <h5>II. Estudiante</h5>
            <div class="mb-3">
                <label for="nombre_estudiante" class="form-label">Nombre y Apellidos:</label>
                <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="grado_seccion" class="form-label">Grado y Sección:</label>
                <input type="text" class="form-control" id="grado_seccion" name="grado_seccion" required>
            </div>

            <h5>III. Derivación de Caso</h5>
            <div class="mb-3">
                <label class="form-label">Derivación:</label><br>
                <input type="checkbox" id="direccion" name="derivacion[]" value="direccion">
                <label for="direccion">Por parte de Dirección</label><br>
                <input type="checkbox" id="tutor_docente" name="derivacion[]" value="tutor_docente">
                <label for="tutor_docente">Por parte del tutor/docente</label><br>
                <input type="checkbox" id="auxiliar_psicologa" name="derivacion[]" value="auxiliar_psicologa">
                <label for="auxiliar_psicologa">Pedido del auxiliar/Psicóloga</label><br>
                <input type="checkbox" id="iniciativa_estudiante" name="derivacion[]" value="iniciativa_estudiante">
                <label for="iniciativa_estudiante">Por iniciativa de la estudiante</label><br>
                <input type="checkbox" id="pedido_padre" name="derivacion[]" value="pedido_padre">
                <label for="pedido_padre">Pedido del padre/madre de familia</label><br>
            </div>

            <h5>IV. Motivo de Consulta</h5>
            <div class="mb-3">
                <label for="motivo_consulta" class="form-label">Motivo de Consulta:</label>
                <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" rows="3"></textarea>
            </div>

            <h5>V. Antecedentes Relevantes</h5>
            <div class="mb-3">
                <label for="antecedentes_relevantes" class="form-label">Antecedentes Relevantes:</label>
                <textarea class="form-control" id="antecedentes_relevantes" name="antecedentes_relevantes" rows="3"></textarea>
            </div>

            <h5>VI. Intervención y Compromiso</h5>
            <div class="mb-3">
                <label for="intervencion_compromiso" class="form-label">Intervención y Compromiso:</label>
                <textarea class="form-control" id="intervencion_compromiso" name="intervencion_compromiso" rows="3"></textarea>
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
