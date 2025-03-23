<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Asegúrate de que este link esté presente -->
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <title>Sistema Psicología</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('styles')
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <nav class="flex-column sidebar p-3" style="width: 250px;">
            <h3 class="text-center">Menú</h3>
            <img src="{{ asset('images/' . (session('foto', 'default.png'))) }}" alt="Foto" class="img-fluid rounded-circle mb-3">
            <p class="text-center">{{ session('nombre', 'Lic. Nombre Psicóloga') }}</p>

            <a href="{{ route('inicio') }}" class="nav-link">
                <i class="bi bi-house-door"></i> Inicio
            </a>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-person-bounding-box"></i> Ficha de Psicología
                </a>
                <div class="submenu ps-3">
                    <a href="{{ route('ficha.estudiante') }}" class="nav-link"><i class="bi bi-person"></i> Estudiantes</a>
                    <a href="{{ route('ficha.padre') }}" class="nav-link"><i class="bi bi-person-lines-fill"></i> Padres de Familia</a>
                    <a href="{{ route('ficha.docente') }}" class="nav-link"><i class="bi bi-person-check"></i> Docentes</a>
                </div>
            </div>

            <a href="{{ route('seguimiento.index') }}" class="nav-link">
                <i class="bi bi-clipboard-check"></i> Seguimiento
            </a>

            <a href="{{ route('voz') }}" class="nav-link">
                <i class="bi bi-mic"></i> Control de Voz
            </a>

            <a href="{{ route('alumnos.index') }}" class="nav-link">
                <i class="bi bi-person"></i> Alumnos
            </a>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-calendar-check"></i> Citas
                </a>
                <div class="submenu ps-3">
                    <a href="{{ route('citas.nuevas') }}" class="nav-link"><i class="bi bi-calendar-plus"></i> Citas Nuevas</a>
                    <a href="{{ route('citas.ver') }}" class="nav-link"><i class="bi bi-calendar"></i> Ver Citas</a>
                </div>
            </div>

            <a href="{{ route('ajustes') }}" class="nav-link">
                <i class="bi bi-gear"></i> Ajustes
            </a>

            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>

        <div class="flex-grow-1 p-4 content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/voice-control.js') }}"></script>

    @yield('scripts')
</body>
</html>
