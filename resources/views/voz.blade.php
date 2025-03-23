@extends('layouts.app')

@section('styles')
    <style>
        /* Estilos adicionales si es necesario */
        .control-voz {
            margin-top: 20px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1>Control de Voz</h1>
        <div class="control-voz">
            <button id="start-button" class="btn btn-primary">Activar Control de Voz</button>
            <button id="stop-button" class="btn btn-danger" style="display: none;">Desactivar Control de Voz</button>
            <p id="status-message"></p>
        </div>
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

        // Función para iniciar el reconocimiento de voz
        function startRecognition() {
            recognition.start();
            localStorage.setItem('voiceControlActive', 'true');
            statusMessage.textContent = 'Reconocimiento de voz activado. ¡Puedes hablar!';
            startButton.style.display = 'none'; // Oculta el botón de inicio
            stopButton.style.display = 'inline-block'; // Muestra el botón de detener
            speak('Hola, soy asistente virtual.'); // Saludo de voz al iniciar
        }

        // Función para detener el reconocimiento de voz
        function stopRecognition() {
            recognition.stop();
            localStorage.setItem('voiceControlActive', 'false');
            statusMessage.textContent = 'Reconocimiento de voz desactivado.';
            stopButton.style.display = 'none'; // Oculta el botón de detener
            startButton.style.display = 'inline-block'; // Muestra el botón de inicio
        }

        // Función para que el asistente hable
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

    } else if (command.includes('desactivar')) {
        stopGlobalRecognition();
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

        // Evento cuando se obtiene un resultado del reconocimiento
        recognition.onresult = function(event) {
            const command = event.results[0][0].transcript.toLowerCase();
            handleVoiceCommand(command); // Maneja el comando de voz
        };

        // Evento cuando el reconocimiento se detiene
        recognition.onend = function() {
            if (localStorage.getItem('voiceControlActive') === 'true') {
                // Reinicia el reconocimiento al finalizar si estaba activo
                startRecognition();
            }
        };

        // Verifica si el control de voz estaba activo y reinicia si es necesario
        window.onload = function() {
            if (localStorage.getItem('voiceControlActive') === 'true') {
                startRecognition(); // Inicia el reconocimiento si estaba activo
            } else {
                startButton.style.display = 'inline-block'; // Muestra el botón de inicio si está inactivo
            }
        };

        // Eventos de los botones
        startButton.addEventListener('click', startRecognition);
        stopButton.addEventListener('click', stopRecognition);
    </script>
@endsection
