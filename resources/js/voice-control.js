document.addEventListener('DOMContentLoaded', function () {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();
    recognition.lang = 'es-ES';
    recognition.interimResults = true;
    recognition.maxAlternatives = 1;

    const statusMessage = document.getElementById('status-message');
    const startButton = document.getElementById('start-button');
    const stopButton = document.getElementById('stop-button');

    function startRecognition() {
        recognition.start();
        localStorage.setItem('voiceControlActive', 'true');
        if (statusMessage) statusMessage.textContent = 'Reconocimiento de voz activado. ¡Puedes hablar!';
        if (stopButton) stopButton.style.display = 'inline-block';
        speak('Hola, soy asistente virtual.');
    }

    function stopRecognition() {
        recognition.stop();
        localStorage.setItem('voiceControlActive', 'false');
        if (statusMessage) statusMessage.textContent = 'Reconocimiento de voz desactivado.';
        if (stopButton) stopButton.style.display = 'none';
    }

    function speak(text) {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'es-ES';
        window.speechSynthesis.speak(utterance);
    }

    recognition.onresult = function(event) {
        const command = event.results[0][0].transcript.toLowerCase();
        handleVoiceCommand(command);
    };

    recognition.onend = function() {
        if (localStorage.getItem('voiceControlActive') === 'true') {
            // Comentar la siguiente línea si no quieres reiniciar automáticamente
            // startRecognition();
        }
    };

   
    window.onload = function() {
        if (localStorage.getItem('voiceControlActive') === 'true') {
            startRecognition();
        } else {
            if (startButton) startButton.style.display = 'inline-block';
        }
    };

    if (startButton) startButton.addEventListener('click', startRecognition);
    if (stopButton) stopButton.addEventListener('click', stopRecognition);
});
