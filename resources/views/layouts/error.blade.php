<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Sky Free Shop</title>
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
</head>
<body>
    <main class="error-container">
        <div class="logo-box">
        </div>
        <section class="error-box">
            <h1>@yield('title')</h1>
            <p>@yield('message')</p>
            <a href="{{ url('/') }}" class="btn">Volver al inicio</a>
        </section>
    </main>
</body>
</html>
