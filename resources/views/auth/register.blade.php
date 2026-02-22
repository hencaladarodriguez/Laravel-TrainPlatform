<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="auth-body">

    <div class="auth-box">

        <h2>Registro</h2>
        <form id="registerForm">

            <p>Nombre</p>
            <input type="text" name="nombre" required>
            <p>Apellido</p>
            <input type="text" name="apellidos">
            <p>Email</p>
            <input type="email" name="email" required>
            <p>Contraseña</p>
            <input type="password" name="password" required>
            <p>Fecha de Nacimiento</p>
            <input type="date" name="fecha_nacimiento" required>
            <p>Peso Base</p>
            <input type="number" step="0.1" name="peso_base" required>
            <p>Altura Base</p>
            <input type="number" name="altura_base" required>

            <button type="submit">Crear cuenta</button>
        </form>

        <script src="{{ asset('js/app.js') }}"></script>

    </div>

</body>

</html>