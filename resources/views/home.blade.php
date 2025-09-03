
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sky Free Shop - Inicio</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="intro-screen">
        <img src="/imagenes/logo3.png" alt="Sky Free Shop" class="intro-logo">
    </div>

    <div class="main-screen hidden">
        <header class="site-header">
            <img src="/imagenes/logo3.png" alt="Sky Free Shop" class="logo">
            <h3>Portal de empleo </h3>
        </header>
    </div>
        <main class="city-options">
 <div class="grid-container">
        <!-- Tarjeta 1: Viajes -->
        <a href="{{ route('vacantes.vacantes', ['localidad' => 'Aeropuerto Internacional Jose Maria Cordoba']) }}" class="card-button">
            <span class="card-label">Medellín</span>
            <img src="{{asset('imagenes/sky-medellin.jpg')}}" alt="Destinos de Viaje">
            <div class="overlay">
                <h3>Aeropuerto </h3>
                <h3>José María Córdova </h3>
                <p>Ver vacantes</p>
            </div>
        </a>
        
        <!-- Tarjeta 2: Fotografía -->
        <a href="{{ route('vacantes.vacantes', ['localidad' => 'Puerto de manga']) }}" class="card-button">
        <img src="/imagenes/sky-puerto-de-manga.jpg" alt="Sky Free Shop" class="intro-logo">
            <div class="overlay">
                <h3>Puerto de manga </h3>
                <p>Ver vacantes</p>
            </div>
        </a>


    </div>
        </main>
            <h1 class="text-danger text-center">Elige tu ciudad</h1>
    
    <script src="{{ asset('js/inicio.js') }}"></script>
</body>
</html>
