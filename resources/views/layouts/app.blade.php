<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATS')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    .navbar {
        background-color: #840028;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        color: white;
        flex-wrap: wrap;
    }

    .navbar img {
        height: 40px;
        margin-right: 10px;
    }

    .navbar .logo-text {
        font-size: 20px;
        font-weight: bold;
        color: white;
        text-decoration: none;
    }

    .navbar nav a {
        color: white;
        margin-left: 20px;
        text-decoration: none;
        font-weight: bold;
    }

    .navbar nav a:hover {
        text-decoration: underline;
    }
    .nav-btn{
        text-decoration: none;
        color: white;
        border: 2px solid #840028;
        border-radius: 8px;
        font-family: 'Konnect Bold', sans-serif;
        text-align: center;
        transition: background-color 0.4s ease, color 0.4s ease,
        transform 0.4s ease, box-shadow 0.4s ease;
        
    }
    .navbar nav {
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1;
        gap: 20px;
    }
    
    .navbar nav a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.4s, color 0.4s, transform 0.3s, box-shadow 0.3s;
        padding: 8px 18px;
        border-radius: 8px;
        border: 2px solid #840028;
        background: transparent;
        font-family: 'Konnect Bold', sans-serif;
    }
    
    .navbar nav a:hover {
        background-color: #fff;
        color: #840028;
        text-decoration: none;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    }
    
    .logo {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
    }
    .logo:hover {
        transform: scale(1.2);
    }
    
        .logout-btn {
          position: absolute;
          right: 0px;
          margin-left: 10px;
          padding: 8px 16px;
          background-color: #840028;
          color: #fff;
          border: 2px solid #840028;
          border-radius: 8px;
          font-family: 'Konnect Bold', sans-serif;
          text-decoration: none;
          margin-left: 10px;
          cursor: pointer;
          transition: background-color 0.4s ease, color 0.4s ease,
                      transform 0.4s ease, box-shadow 0.4s ease;
        }
        .logout-btn:hover {
          background-color: #fff;
          color: #840028;
          transform: translateY(-3px);
          box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    

  /* ==== BARRA DE NAVEGACIÓN FIJA INFERIOR ==== */
        .fixed-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color:#840028;
            padding: 0.8rem 1rem;
            box-shadow: 0 -8px 20px var(--sombra-profunda);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }

         .nav-link1 {
            flex: 1;
            text-align: center;
            text-decoration: none;
            color: white;
            font-weight: 600;
            padding: 0.5rem 0;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border-radius: 0.75rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }

        .nav-link1.active, .nav-link1:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }

        .nav-link1 svg {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
        .hero h1 {
            font-size: 2rem;
            margin-top: 100px;
        }
    }
</style>
<body>
    <div class="navbar">
        <div style="display: flex; align-items: center;">
            <a href="{{ route('home') }}">
                <img class="logo" src="{{ asset('imagenes/logo3.png') }}" alt="Sky Free Shop Logo">
            </a>
        </div>
    <nav>

        <button onclick="confirmLogout()" class="logout-btn">Cerrar sesión</button>
    </nav>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<nav class="fixed-navbar">
        <a href="{{ route('vacantes.create') }}" class="nav-link1" id="nav-crear-vacante">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            <span>Crear Vacante</span>
        </a>
        <a href="{{ route('vacantes.index') }}" class="nav-link1" id="nav-ver-vacantes">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg>
            <span>Ver Vacantes</span>
        </a>
        <a href="{{ route('panel.candidatos') }}" class="nav-link1" id="nav-ver-candidatos">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 13c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
            <span>Ver Candidatos</span>
        </a>
    </nav>



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmLogout() {
  Swal.fire({
    title: '¿Cerrar sesión?',
    text: "Tu sesión se cerrará.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#840028',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, cerrar sesión',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('logout-form').submit(); // Envia el POST
    }
  });
}

</script>
    @yield('content')
</body>
</html>
