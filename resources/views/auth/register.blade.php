<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Sky Free Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Loader: pantalla de carga (puedes incluirlo si lo usas en todo el sitio) */
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .fade-out {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s;
        }
        body {
            background-color: #800020;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding-top: 80px; /* Espacio para la navbar */
            overflow: auto;
        }
        .navbar {
            width: 100%;
            background: #800020;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 10px 20px;
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 20px;
        }
        .register-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
            margin-top: 20px; /* Espacio para que no se pegue a la navbar */
        }
        .register-container img.logo {
            display: block;
            margin: 10px auto 20px auto;
            max-width: 230px;
            width: 100%;
            height: auto;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #800020;
            color: white;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            transition: background 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background-color: #a52a2a;
        }
        .footer-text {
            font-size: 12px;
            color: #555;
            margin-top: 15px;
        }
        /* Estilos para el input group del teléfono */
        .input-group .select-country {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <!-- Loader si deseas usarlo -->
    <div id="loader" style="display: none;">
        <img style="height: 50px; width:50px;" src="{{ asset('imagenes/loader.gif') }}" alt="Cargando...">
    </div>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Sky Free Shop</a>
        </div>
    </nav>

    <div class="register-container">
        <img class="logo" src="{{ asset('imagenes/logo1.jpg') }}" alt="Sky Free Shop Logo">

        <!-- Mensaje de error o status de la sesión -->
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {!! session('error')['mensaje'] !!}
            </div>
        @endif

        <h4 class="mb-3">Crear Cuenta</h4>

        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf

            <!-- Nombre -->
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                <label for="floatingName">Nombre</label>
                @error('name')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Nombre de usuario -->
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
                <label for="floatingUsername">Nombre de usuario</label>
                @error('username')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Correo Electrónico -->
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                <label for="floatingEmail">Correo Electrónico</label>
                @error('email')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Contraseña" required>
                <label for="floatingPassword">Contraseña</label>
                @error('password')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-floating mb-3">
                <input type="password" name="password_confirmation" class="form-control" id="floatingPasswordConfirm" placeholder="Confirmar Contraseña" required>
                <label for="floatingPasswordConfirm">Confirmar Contraseña</label>
                @error('password_confirmation')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Teléfono (opcional, si deseas incluir) -->
            <div class="mb-3">
                <label class="form-label" for="phone-group">Teléfono</label>
                <div class="input-group" id="phone-group">
                    <!-- Aquí colocarías un select para el código del país -->
                    <select name="country_code" class="form-select select-country" id="floatingCountryCode" required>
                        <option value="" disabled selected>País</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais['code'] }}"
                                {{ isset($paisPredeterminado) && $paisPredeterminado === $pais['code'] ? 'selected' : '' }}>
                                {{ $pais['name'] }} ({{ $pais['code'] }})
                            </option>
                        @endforeach
                    </select>
                    <!-- Campo para el número -->
                    <input type="tel" name="telefono" class="form-control" id="floatingNumber" placeholder="Número de Teléfono" value="{{ old('telefono') }}" required>
                </div>
                @error('telefono')
                    <div class="text-danger text-start small mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-custom">Registrarse</button>
        </form>

        <p class="mt-3">
            ¿Ya tienes una cuenta? 
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">Inicia sesión aquí</a>
        </p>

        <p class="footer-text">Sky Free Shop &copy; 2025</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ejemplo para ocultar el loader cuando la página se cargue
        window.addEventListener('load', function () {
            const loader = document.getElementById('loader');
            if(loader) {
                loader.classList.add('fade-out');
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }

            // Listener al enviar el formulario para mostrar el loader
            const form = document.getElementById('register-form');
            if(form){
                form.addEventListener('submit', function () {
                    const loader = document.getElementById('loader');
                    if(loader) {
                        loader.classList.remove('fade-out');
                        loader.style.display = 'flex';
                    }
                });
            }
        });
    </script>
</body>
</html>
