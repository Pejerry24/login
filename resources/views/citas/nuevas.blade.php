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
                window.location.href = '/ficha/padre/de/familia';

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
