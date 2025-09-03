@extends('layouts.usuarios') {{-- Asume que tienes un layout base llamado "app.blade.php" --}}
@section('content')



  <link rel="stylesheet" href="{{ asset('css/perfil.css') }}"> 
  
</head>
<body>
  <!-- Botón para dispositivos pequeños (menú offcanvas) -->



  <main class="container">
    <div class="profile-header">
      {{-- Usamos el usuario autenticado --}}
      <img
        src="{{ asset($usuario->foto) }}"
        alt="{{ $usuario->name }} {{$usuario->apellido }}"
      >
      <h2>{{ $usuario->name }} {{$usuario->apellido }}</h2>
      <p>{{ $usuario->email }}</p>
    </div>

    <div class="modulo-general">
      <div class="verificacion">
    <h3>Verificación de seguridad</h3>

    @if(!$usuario->email_verified_at && !$usuario->google2fa_secret)
        <p>No has configurado la verificación. Elige una opción:</p>
        <a href="{{ route('2fa.email.setup') }}" class="btn">Verificar por correo</a>
        <a href="{{ route('2fa.setup') }}" class="btn">Verificar con Google Authenticator</a>
    @elseif($usuario->email_verified_at)
        <p>✅ Verificación por correo completada</p>
    @elseif($usuario->google2fa_secret)
        <p>✅ Verificación con Google Authenticator activa</p>
    @endif
</div>

      

      

    </div>
  </main>
@endsection
</html>
