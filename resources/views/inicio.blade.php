@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Tarjetas de estadísticas -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Estadísticas Semanales</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $fichasSemanales['total'] }}</h5>
                    <p>Fichas registradas esta semana</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Estadísticas Mensuales</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $fichasMensuales['total'] }}</h5>
                    <p>Fichas registradas este mes</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Estadísticas Anuales</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $fichasAnuales['total'] }}</h5>
                    <p>Fichas registradas este año</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico Comparativo -->
    <h4>Gráfico Comparativo</h4>
    <canvas id="myChart"></canvas>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Probar la API de síntesis de voz con un mensaje simple al cargar la página
        function reproducirMensaje(mensaje) {
            const synth = window.speechSynthesis;
            const utterance = new SpeechSynthesisUtterance(mensaje);
            utterance.lang = 'es-ES'; // Establecer idioma a español
            synth.speak(utterance);
        }

        // Forzar la reproducción de un mensaje de prueba
        reproducirMensaje('Hola Buenas Noches.');

        // Verificación de citas
        @if($citasHoy->isNotEmpty())
            const saludo = 'Tienes citas programadas para hoy.';
            reproducirMensaje(saludo);
        @else
            console.log("No hay citas para hoy");
        @endif

        // Verificación de datos en consola
        console.log({
            estudiantes: [
                {{ $fichasSemanales['estudiantes'] }},
                {{ $fichasMensuales['estudiantes'] }},
                {{ $fichasAnuales['estudiantes'] }}
            ],
            padres: [
                {{ $fichasSemanales['padres'] }},
                {{ $fichasMensuales['padres'] }},
                {{ $fichasAnuales['padres'] }}
            ],
            docentes: [
                {{ $fichasSemanales['docentes'] }},
                {{ $fichasMensuales['docentes'] }},
                {{ $fichasAnuales['docentes'] }}
            ]
        });

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Semanal', 'Mensual', 'Anual'],
                datasets: [
                    {
                        label: 'Estudiantes',
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        data: [
                            {{ $fichasSemanales['estudiantes'] }},
                            {{ $fichasMensuales['estudiantes'] }},
                            {{ $fichasAnuales['estudiantes'] }}
                        ]
                    },
                    {
                        label: 'Padres',
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        data: [
                            {{ $fichasSemanales['padres'] }},
                            {{ $fichasMensuales['padres'] }},
                            {{ $fichasAnuales['padres'] }}
                        ]
                    },
                    {
                        label: 'Docentes',
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                        data: [
                            {{ $fichasSemanales['docentes'] }},
                            {{ $fichasMensuales['docentes'] }},
                            {{ $fichasAnuales['docentes'] }}
                        ]
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
     
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
