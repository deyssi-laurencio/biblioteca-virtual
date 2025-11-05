<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Biblioteca Virtual G.U.E. Leoncio Prado')</title>

    <!-- Bootstrap 5 CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilo adicional personalizado -->
    <style>
        body {
            background-color: #e7f3ff; /* Fondo celeste claro */
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>

     <!-- Archivos compilados por Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Barra superior -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
        <div class="container">
            <!-- Logo / Nombre del sistema -->
            <a class="navbar-brand" href="{{ route('home') }}">
                📘 BIBLIOTECA VIRTUAL G.U.E. LEONCIO PRADO
            </a>

            <!-- Opciones de usuario -->
            <div class="d-flex">
                @auth
                    <span class="me-2">👤 {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
