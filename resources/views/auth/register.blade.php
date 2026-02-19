<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="auth-body">

    <div class="auth-box">

        <h2>Registro</h2>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <label>
                Nombre
                <input type="text" name="nombre" placeholder="Nombre" required>
            </label>

            <label>
                Apellidos
                <input type="text" name="apellidos" placeholder="Apellidos">
            </label>

            <label>
                Email
                <input type="email" name="email" placeholder="Email" required>
            </label>

            <label>
                Contraseña
                <input type="password" name="password" placeholder="Password" required>
            </label>

            <label>
                Fecha de Nacimiento
                <input type="date" name="fecha_nacimiento" required>
            </label>

            <label>
                Peso
                <input type="number" step="0.1" name="peso_base" placeholder="Peso" required>
            </label>

            <label>
                Altura (Ejemplo: 170)
                <input type="number" name="altura_base" placeholder="Altura" required>
            </label>
            
            <button type="submit">Crear cuenta</button>
        </form>

    </div>

</body>

</html>