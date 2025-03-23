@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajustes de Usuario</h1>
        
        @if (auth()->check())
            <form action="{{ route('ajustes.actualizar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo para el nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ auth()->user()->nombre }}" required>
                </div>

                <!-- Campo para cambiar el DNI -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" name="dni" id="dni" class="form-control" value="{{ auth()->user()->dni }}" required>
                </div>

                <!-- Campo para cambiar la foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Cambiar Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    @if(auth()->user()->foto) <!-- Solo mostrar la foto si existe -->
                        <img src="{{ asset('images/' . auth()->user()->foto) }}" alt="Foto Actual" class="img-fluid rounded-circle mt-3" width="150">
                    @endif
                </div>

                <!-- Campo para cambiar la contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Dejar en blanco si no deseas cambiar la contraseña.</small>
                </div>

                <!-- Confirmar nueva contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <!-- Botón de Guardar -->
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        @else
            <p>Los cambios son exitosos. Por favor, inicia sesión de nuevo.</p>
        @endif
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

        // Manejo de comandos de voz para redirección
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

    } else if (command.includes('cita')) {
        window.location.href = '/citas/nuevas';
    

    } else if (command.includes('desactivar')) {
        stopRecognition();
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
