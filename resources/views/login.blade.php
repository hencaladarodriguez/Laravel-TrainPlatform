<!DOCTYPE html>
<html>
<head>
    <title>Login Ciclistas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
        }
        
        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #ffcdd2;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4361ee;
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }
        
        button {
            width: 100%;
            padding: 14px;
            background: #4361ee;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        button:hover {
            background: #3a56d4;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login Ciclistas</h1>

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Entrar</button>
        </form>
        
        <div class="login-footer">
            Plataforma de Entrenamientos de Ciclismo
        </div>
    </div>
</body>
</html>