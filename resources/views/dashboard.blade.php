<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Plataforma Entrenamientos</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 20px;
            background: #f0f2f5;
        }
        
        /* MENÚ SIMPLE */
        .menu { 
            background: #2c3e50; 
            padding: 15px; 
            margin-bottom: 25px; 
            border-radius: 8px;
        }
        
        .menu ul { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
            display: flex; 
            flex-wrap: wrap;
        }
        
        .menu li { 
            margin-right: 20px; 
            position: relative; 
        }
        
        .menu a { 
            color: white; 
            text-decoration: none; 
            padding: 8px 15px; 
            display: block;
            border-radius: 4px;
        }
        
        .menu a:hover { 
            background: #34495e; 
        }
        
        .menu li:last-child {
            margin-left: auto;
            margin-right: 0;
        }
        
        .menu li:last-child a {
            background: #e74c3c;
        }
        
        .menu li:last-child a:hover {
            background: #c0392b;
        }
        
        /* SUBMENÚ SIMPLE */
        .submenu { 
            display: none; 
            position: absolute; 
            background: white; 
            min-width: 200px; 
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 100;
            padding: 5px 0;
        }
        
        .submenu li {
            margin: 0;
        }
        
        .submenu a {
            color: #333;
            padding: 8px 15px;
        }
        
        .submenu a:hover {
            background: #f5f5f5;
            color: #2c3e50;
        }
        
        .menu li:hover .submenu { 
            display: block; 
        }
        
        /* CONTENIDO */
        .welcome {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }
        
        .welcome h1 {
            color: #2c3e50;
            margin-top: 0;
        }
        
        /* TARJETAS SIMPLES */
        .stats { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 20px; 
        }
        
        .card { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            border-top: 3px solid #3498db;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .card:nth-child(2) {
            border-top-color: #2ecc71;
        }
        
        .card:nth-child(3) {
            border-top-color: #f39c12;
        }
        
        .card h3 { 
            color: #2c3e50; 
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .card p {
            color: #555;
            line-height: 1.5;
        }
        
        .card a {
            display: inline-block;
            padding: 8px 16px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
        
        .card a:hover {
            background: #2980b9;
        }
        
        .card:nth-child(2) a {
            background: #2ecc71;
        }
        
        .card:nth-child(2) a:hover {
            background: #27ae60;
        }
        
        .card:nth-child(3) a {
            background: #f39c12;
            color: #333;
        }
        
        .card:nth-child(3) a:hover {
            background: #d68910;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .menu ul {
                flex-direction: column;
            }
            
            .menu li {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .menu li:last-child {
                margin-left: 0;
            }
            
            .submenu {
                position: static;
                width: 100%;
                margin-top: 5px;
            }
            
            .stats {
                grid-template-columns: 1fr;
            }
        }
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
            <li>
                <a href="{{ route('logout') }}">Cerrar sesión</a>
            </li>
        </ul>
    </div>

    <div class="welcome">
        <h1>Bienvenido, {{ $nombre }}</h1>
        <p>Plataforma de gestión de entrenamientos de ciclismo</p>
    </div>
    
    <div class="stats">
        <div class="card">
            <h3>Mis Planes</h3>
            <p>Gestiona tus planes de entrenamiento.</p>
            <a href="{{ route('planes.index') }}">Ver planes</a>
        </div>
        
        <div class="card">
            <h3>Mi Perfil</h3>
            <p><strong>ID:</strong> {{ session('ciclista_id') }}</p>
            <p><strong>Email:</strong> {{ session('ciclista_email') ?? 'No registrado' }}</p>
            <a href="#">Ver perfil</a>
        </div>
        
        <div class="card">
            <h3>Actividad</h3>
            <p>Sesiones completadas: 0</p>
            <p>Planes activos: 0</p>
            <a href="#">Ver actividad</a>
        </div>
    </div>
</body>
</html>