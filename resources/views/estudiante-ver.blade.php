@extends('layouts.app')

@section('content')
<style>
    /* Estilo para formato A4 */
    @media print {
        body {
            margin: 0;
            padding: 0;
            background: white;
            color: black;
        }

        /* Oculta el menú y otros elementos no deseados */
        header, footer, nav, .sidebar, .btn {
            display: none !important; /* Asegúrate de ocultar todo lo que no quieres imprimir */
        }

        .container {
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            margin: auto;
            border: none;
        }

        .header, .footer {
            display: block;
            text-align: center;
        }

        .header img {
            max-height: 100px;
            width: auto;
            margin: 0 10px; /* Espaciado entre imágenes */
        }

        h1, h2, h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    }

    /* Estilo general para la página */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        width: 100%;
        max-width: 900px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ddd;
        background: #f9f9f9;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        text-align: center;
    }

    .header img {
        height: 100px; /* Ajusta el tamaño según sea necesario */
    }

    .header h1 {
        font-size: 24px;
        margin: 0;
    }

    .sub-header {
        margin-top: -20px;
        font-weight: normal;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        margin: auto;
        width: 100%;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: left;
    }

    .form-container h1 {
        text-align: center;
        color: #333;
        font-size: 24px; /* Ajusta este valor si es necesario */
    }

    h2 {
        font-size: 18px; /* Ajusta este valor si es necesario */
        color: #333;
    }

    .datos-generales {
        display: flex;
        justify-content: space-between;
    }

    .columna {
        width: 45%; /* Ajusta el ancho según sea necesario */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"], input[type="number"], textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .checkbox-group {
        margin-bottom: 15px;
    }

    .checkbox-group label {
        display: inline-block;
        margin-right: 15px;
    }

    textarea {
        height: 100px;
        resize: none;
    }

    .submit-btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
</style>

<div class="container">
    <div class="header">
        <img src="{{ asset('images/educacion.png') }}" alt="Logo Izquierda">
        <div>
            <h1>INSTITUCIÓN EDUCATIVA "JOSÉ OLAYA BALANDRA"</h1>
            <h1>Santa Rosa</h1>
            <p>-------------------------------------------------</p>
            <p class="sub-header">R.D No 0232 del 17-03-78 CM. 0543509 RUC No 20479373722</p>
            <p class="sub-header">PROLONG. MICAELA BASTIDAS S/N, <a href="mailto:joseolayabalandra@yahoo.es">joseolayabalandra@yahoo.es</a></p>
        </div>
        <img src="{{ asset('images/favicon.ico.png') }}" alt="Logo Derecha">
    </div>

    <div class="form-container">
        <h1>FICHA DE PSICOLÓGICA DE ESTUDIANTES</h1>
        <p>FECHA: 19/11/2024</p>

        <h2>I - DATOS GENERALES:</h2>
        <div class="datos-generales">
            <div class="columna">
                <label>1. Nombre y Apellido:</label>
                <input type="text" name="nombre_apellido" value="{{ $ficha->nombre_apellido }}">
                <label>2. Edad:</label>
                <input type="number" name="edad" value="{{ $ficha->edad }}">
                <label>3. Grado y sección:</label>
                <input type="text" name="grado_seccion" value="{{ $ficha->grado_seccion }}">
                <label>4. Tutor:</label>
                <input type="text" name="tutor" value="{{ $ficha->tutor }}">
                <label>5. Domicilio:</label>
                <input type="text" name="domicilio" value="{{ $ficha->domicilio }}">
            </div>
            <div class="columna">
                <label>6. Vives con:</label>
                <input type="text" name="vives_con" value="{{ $ficha->vives_con }}">
                <label>7. Fecha de Nacimiento:</label>
                <input type="text" name="fecha_nacimiento" value="{{ $ficha->fecha_nacimiento }}">
                <label>8. Lugar de procedencia:</label>
                <input type="text" name="lugar_procedencia" value="{{ $ficha->lugar_procedencia }}">
                <label>9. Religión:</label>
                <input type="text" name="religion" value="{{ $ficha->religion }}">
            </div>
        </div>

        <h2>II - DERIVACIÓN DE CASO:</h2>
        <div class="checkbox-group">
            <label>Por parte de dirección:</label>
            <input type="checkbox" name="derivacion_direccion" {{ $ficha->derivacion_direccion ? 'checked' : '' }}> 
            <label>Por iniciativa del estudiante:</label>
            <input type="checkbox" name="iniciativa_estudiante" {{ $ficha->iniciativa_estudiante ? 'checked' : '' }}> 
            <label>Por parte del tutor/docente:</label>
            <input type="checkbox" name="tutor_docente" {{ $ficha->tutor_docente ? 'checked' : '' }}> 
            <label>Por iniciativa de otro estudiante/familiar:</label>
            <input type="checkbox" name="iniciativa_familiar" {{ $ficha->iniciativa_familiar ? 'checked' : '' }}> 
            <label>Pedido del auxiliar/Psicología:</label>
            <input type="checkbox" name="pedido_auxiliar" {{ $ficha->pedido_auxiliar ? 'checked' : '' }}> 
            <label>Pedido del padre/madre de familia:</label>
            <input type="checkbox" name="pedido_padre" {{ $ficha->pedido_padre ? 'checked' : '' }}> 
        </div>

        <h2>III - MOTIVO DE CONSULTA:</h2>
        <textarea name="motivo_consulta">{{ $ficha->motivo_consulta }}</textarea>

        <h2>IV - ANTECEDENTES RELEVANTES:</h2>
        <textarea name="antecedentes_relevantes">{{ $ficha->antecedentes_relevantes }}</textarea>

        <h2>V - RELACIÓN FAMILIAR:</h2>
        <textarea name="relacion_familiar">{{ $ficha->relacion_familiar }}</textarea>

        <h2>VI - INTERVENCIÓN Y COMPROMISO:</h2>
        <textarea name="intervencion_compromiso">{{ $ficha->intervencion_compromiso }}</textarea>

        <div class="footer">
            <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
        </div>
    </div>
</div>
@endsection
