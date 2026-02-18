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

        <input type="text" name="nombre" placeholder="Nombre" required>

        <input type="text" name="apellidos" placeholder="Apellidos">

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Crear cuenta</button>
    </form>

</div>

</body>
</html>
