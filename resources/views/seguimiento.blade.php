@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Búsqueda de Fichas</h3>
    <form id="search-form" action="{{ route('seguimiento.buscar') }}" method="GET">
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <div class="input-group">
                <input type="text" name="dni" id="dni" class="form-control" placeholder="Ingrese el DNI" required>
                <button type="button" id="microphone-button" class="btn btn-secondary">🎤</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @if(session('error'))
        <p class="mt-3 text-danger">{{ session('error') }}</p>
    @endif

    @if(isset($fichas) && !$fichas->isEmpty())
        <h2 class="mt-4">Resultados de la búsqueda</h2>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre y Apellidos</th>
                    <th>Tipo de Ficha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fichas as $index => $ficha)
                    <tr>
                        <td>{{ $ficha['dni'] }}</td>
                        <td>{{ $ficha['nombre'] }}</td>
                        <td>{{ $ficha['tipo_ficha'] }}</td>
                        <td>
                            <a href="{{ route('ficha.ver', ['tipoFicha' => strtolower($ficha['tipo_ficha']), 'id' => $ficha['id']]) }}" class="btn btn-info">Ver Ficha {{ $index + 1 }}</a>
                            <form action="{{ route('ficha.eliminar', ['tipoFicha' => strtolower($ficha['tipo_ficha']), 'id' => $ficha['id']]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta ficha?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@section('scripts')
<script>
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    
    // 1. Reconocimiento para comandos globales
    const globalRecognition = new SpeechRecognition();
    globalRecognition.lang = 'es-ES';
    globalRecognition.interimResults = true;
    globalRecognition.maxAlternatives = 1;

    // 2. Reconocimiento para DNI
    const dniRecognition = new SpeechRecognition();
    dniRecognition.lang = 'es-ES';
    dniRecognition.interimResults = false; // No queremos resultados intermedios en DNI

    const dniInput = document.getElementById('dni');
    const microphoneButton = document.getElementById('microphone-button');
    const searchForm = document.getElementById('search-form');
    const statusMessage = document.getElementById('status-message');

    // Funciones para manejo del reconocimiento global
    function startGlobalRecognition() {
        globalRecognition.start();
        localStorage.setItem('voiceControlActive', 'true');
        if (statusMessage) {
            statusMessage.textContent = 'Reconocimiento de voz activado para comandos globales.';
        }
    }

    function stopGlobalRecognition() {
        globalRecognition.stop();
        localStorage.setItem('voiceControlActive', 'false');
        if (statusMessage) {
            statusMessage.textContent = 'Reconocimiento de voz global desactivado.';
        }
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

    globalRecognition.onresult = (event) => {
        const command = event.results[0][0].transcript.toLowerCase();
        handleVoiceCommand(command);
    };

    globalRecognition.onend = () => {
        if (localStorage.getItem('voiceControlActive') === 'true') {
            startGlobalRecognition(); // Reinicia el reconocimiento si estaba activo
        }
    };

    // Iniciar reconocimiento global al cargar la página si estaba activo previamente
    window.onload = () => {
        if (localStorage.getItem('voiceControlActive') === 'true') {
            startGlobalRecognition();
        }
    };

    // 3. Eventos de reconocimiento de DNI
    microphoneButton.addEventListener('click', () => {
        dniRecognition.start();
        microphoneButton.disabled = true; 
    });

    dniRecognition.onresult = (event) => {
        const command = event.results[0][0].transcript;
        const dniOnly = command.replace(/\D/g, ''); 
        if (dniOnly.length === 8) { 
            dniInput.value = dniOnly;
            searchForm.submit();
        } else {
            alert("Por favor, asegúrate de que has dicho un DNI válido (8 dígitos).");
        }
        microphoneButton.disabled = false;
    };

    dniRecognition.onerror = (event) => {
        console.error('Error en el reconocimiento: ', event.error);
        microphoneButton.disabled = false;
    };

</script>
@endsection
@endsection
