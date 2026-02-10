<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido {{ $nombre }}</h1>

    <h2>Menú principal</h2>
    <ul>
        @foreach($menus as $menu)
            <li>
                {{ $menu['nombre'] }}
                <ul>
                    @foreach($menu['submenus'] as $submenu)
                        <li><a href="{{ $submenu['url'] }}">{{ $submenu['nombre'] }}</a></li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('logout') }}">Cerrar sesión</a>
</body>
</html>
