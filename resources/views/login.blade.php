<!DOCTYPE html>
<html>
<head>
    <title>Login Ciclistas</title>
</head>
<body>
    <h1>Login Ciclistas</h1>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
