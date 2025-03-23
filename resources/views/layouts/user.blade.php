<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        /* Estilo para la imagen de fondo */
        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/Colegio.jpg'); /* Ruta de la imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Estilo del contenedor del formulario */
        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semitransparente */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        /* Estilo para los campos del formulario */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        /* Botón de inicio de sesión */
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <input type="text" name="dni" placeholder="DNI" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div>
                <button type="submit">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</body>
</html>
