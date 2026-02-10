<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Plataforma Entrenamientos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .menu { background: #333; padding: 10px; margin-bottom: 20px; }
        .menu ul { list-style: none; padding: 0; margin: 0; display: flex; }
        .menu li { margin-right: 20px; position: relative; }
        .menu a { color: white; text-decoration: none; padding: 5px 10px; }
        .menu a:hover { background: #555; }
        .submenu { display: none; position: absolute; background: #444; }
        .menu li:hover .submenu { display: block; }
        .stats { display: flex; gap: 20px; margin-top: 30px; }
        .card { background: #f5f5f5; padding: 20px; border-radius: 8px; flex: 1; }
    </style>
</head>
<body>
    <div class="menu">
        <ul>
            @foreach($menus as $menu)
                <li>
                    <a href="#">{{ $menu['nombre'] }}</a>
                    @if(isset($menu['submenus']))
                        <ul class="submenu">
                            @foreach($menu['submenus'] as $submenu)
                                <li><a href="{{ $submenu['url'] }}">{{ $submenu['nombre'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            <li style="margin-left: auto;">
                <a href="{{ route('logout') }}">Cerrar sesión</a>
            </li>
        </ul>
    </div>

    <h1>👋 Bienvenido, {{ $nombre }}</h1>
    
    <div class="stats">
        <div class="card">
            <h3>Mis Planes</h3>
            <p>Próximamente: Lista de planes</p>
            <a href="/planes">Ver planes</a>
        </div>
        
        <div class="card">
            <h3>Mi Perfil</h3>
            <p>ID: {{ session('ciclista_id') }}</p>
            <a href="#">Ver mi perfil</a>
        </div>
        
        <div class="card">
            <h3>Actividad</h3>
            <p>Sesiones completadas: 0</p>
            <a href="#">Ver actividad</a>
        </div>
    </div>
</body>
</html>