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

            <input type="text" name="nombre" required>
            <input type="text" name="apellidos">
            <input type="email" name="email" required>
            <input type="password" name="password" required>
            <input type="date" name="fecha_nacimiento" required>
            <input type="number" step="0.1" name="peso_base" required>
            <input type="number" name="altura_base" required>

            <button type="submit">Crear cuenta</button>
        </form>

        <script src="{{ asset('js/app.js') }}"></script>

    </div>

</body>

</html>