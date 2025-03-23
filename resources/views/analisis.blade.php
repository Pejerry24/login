@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Análisis de Sentimiento</h1>
        <form action="/analizar-sentimiento" method="POST">
            @csrf
            <label for="texto">Introduce el texto para análisis de sentimiento:</label>
            <textarea name="texto" id="texto" rows="4" class="form-control" required></textarea>
            <button type="submit" class="btn btn-primary mt-3">Analizar</button>
        </form>

        @if (isset($resultado))
            <div class="alert alert-info mt-3">
                <strong>Resultado:</strong> {{ $resultado['label'] }} con una precisión de {{ number_format($resultado['score'], 2) }}.
            </div>
        @endif
    </div>
@endsection
