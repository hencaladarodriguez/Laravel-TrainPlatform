<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="auth-body">

<div class="auth-box">

    <h2>Login</h2>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Entrar</button>
    </form>

    <a href="{{ route('register') }}">Registrarse</a>

</div>

</body>
</html>
