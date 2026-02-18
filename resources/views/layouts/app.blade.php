<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Entrenamientos</title>
    <link rel="stylesheet" href="{{ asset('./css/app.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <h2 class="logo">Entrenamientos</h2>

        <div class="container">
            @yield('content')
        </div>
        
        <ul class="nav-links">
            <li><a href="{{ route('bloques.index') }}">Bloques</a></li>
            <li><a href="{{ route('sesionBloques.index') }}">Sesión Bloques</a></li>
            <li><a href="{{ route('sesiones.index') }}">Sesiones</a></li>
            <li><a href="{{ route('planes.index') }}">Planes</a></li>
            <li><a href="{{ route('resultados.index') }}">Resultados</a></li>
        </ul>
    </div>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</nav>



</body>
</html>
