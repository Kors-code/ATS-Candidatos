<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sky Free Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #800020;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding-top: 80px;
        }
        .navbar {
            background-color: #800020;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            padding: 10px 20px;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .logo {
            max-width: 230px;
            height: auto;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #800020;
            color: #fff;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #a52a2a;
        }
        .form-check {
            text-align: left;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Sky Free Shop</a>
        </div>
    </nav>

    <div class="login-container">
        <img src="{{ asset('imagenes/logo1.jpg') }}" alt="Sky Free Shop Logo" class="logo">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h4 class="mb-3">Iniciar Sesión</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-floating mb-3">
                 <input type="text" name="login" class="form-control" id="loginInput" placeholder="Correo o usuario" value="{{ old('login') }}" required autofocus>
                    <label for="loginInput">Correo o usuario</label>
                    @error('login')
                        <div class="text-danger text-start small mt-1">{{ $message }}</div>
                    @enderror

            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Contraseña" required>
                <label for="passwordInput">Contraseña</label>
                @error('password')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-custom">Ingresar</button>

            <div class="mt-3">
                ¿Aún no estás registrado?
                <a class="btn btn-outline-secondary" href="{{ route('register') }}">Regístrate aquí</a>
            </div>

            @if (Route::has('password.request'))
                <div class="mt-2">
                    <a class="btn btn-outline-secondary" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
            @endif
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
