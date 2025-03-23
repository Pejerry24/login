@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Citas Guardadas</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Motivo</th>
                <th>Atendida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->nombre }}</td>
                    <td>{{ $cita->motivo }}</td>

                    <!-- Columna de Atendida -->
                    <td>
                        <form action="{{ route('citas.marcar', $cita->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="atendida" onchange="this.form.submit()">
                                <option value="1" {{ $cita->atendida ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$cita->atendida ? 'selected' : '' }}>No</option>
                            </select>
                        </form>
                    </td>

                    <td>
                        <!-- Formulario para eliminar la cita -->
                        <form action="{{ route('citas.eliminar', $cita->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
