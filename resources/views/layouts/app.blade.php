<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Entrenamientos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <h2 class="logo">Entrenamientos</h2>
            <ul class="nav-links">
                <li><a href="#" data-api="/api/bloques">Bloques</a></li>
                <li><a href="#" data-api="/api/sesion-bloques">Sesión Bloques</a></li>
                <li><a href="#" data-api="/api/sesiones">Sesiones</a></li>
                <li><a href="#" data-api="/api/planes">Planes</a></li>
                <li><a href="#" data-api="/api/resultados">Resultados</a></li>
            </ul>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container" id="contenido">
        <p>Selecciona una sección del menú para ver los datos.</p>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
