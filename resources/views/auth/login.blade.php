<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sky Free Shop</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

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



            @if (Route::has('password.request'))
                <div class="mt-2">
                    <a class="btn btn-outline-secondary" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
            @endif
        </form>
    </div>

</body>
</html>
