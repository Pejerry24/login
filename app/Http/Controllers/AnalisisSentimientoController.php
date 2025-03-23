<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnalisisSentimientoController extends Controller
{
    public function mostrarFormulario()
    {
        return view('analisis');
    }

    public function analizarSentimiento(Request $request)
{
    $texto = $request->input('texto');

    // Hacer la solicitud a la API de Hugging Face
    $response = Http::withToken(env('HUGGING_FACE_API_TOKEN'))
        ->post('https://api-inference.huggingface.co/models/nlptown/bert-base-multilingual-uncased-sentiment', [
            'inputs' => $texto,
        ]);

    // Verificar si la respuesta es exitosa
    if ($response->successful()) {
        $resultado = $response->json();

        // Obtener el primer elemento que contiene las etiquetas y puntajes
        $sentimientos = $resultado[0];

        // Buscar el sentimiento con el puntaje más alto
        $mejorResultado = null;
        $mejorPuntaje = 0;

        foreach ($sentimientos as $sentimiento) {
            if ($sentimiento['score'] > $mejorPuntaje) {
                $mejorPuntaje = $sentimiento['score'];
                // Convertir la etiqueta a español
                switch ($sentimiento['label']) {
                    case '1 star':
                        $mejorResultado = '1 estrella';
                        break;
                    case '2 stars':
                        $mejorResultado = '2 estrellas';
                        break;
                    case '3 stars':
                        $mejorResultado = '3 estrellas';
                        break;
                    case '4 stars':
                        $mejorResultado = '4 estrellas';
                        break;
                    case '5 stars':
                        $mejorResultado = '5 estrellas';
                        break;
                    default:
                        $mejorResultado = 'Sin etiqueta';
                        break;
                }
            }
        }

        // Devolver la vista con el mejor resultado
        return view('analisis', [
            'resultado' => [
                'label' => $mejorResultado,
                'score' => $mejorPuntaje,
            ],
        ]);
    } else {
        return view('analisis', [
            'resultado' => 'Error en la solicitud a la API: ' . $response->status(),
        ]);
    }
 }
}