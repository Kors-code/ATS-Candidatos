<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sky Free Shop - Vacante: {{ $vacante->titulo }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vacanteshow.css') }}">

</head>
<body>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="main-container">
  <div class="left-section">
    <div class="overlay">
      <h1>Requisitos</h1>
@if ($vacante->requisitos)
    <ul>
        @foreach ($vacante->requisitos as $requisito)
            <li>{{ $requisito }}</li>
        @endforeach
    </ul>
@else
    <p>No hay requisitos.</p>
@endif

      <h1>Beneficios</h1>
      <ul>
        <li>Poliza de vida</li>
        <li>Descuentos en gimnasio
        <li>Acompañamiento psicologico</li>
        <li>Dias libres en fechas especiales: cumpleaños. grados</li>
        <li>Clases de Ingles</li>
        @if ($vacante->beneficios)
        @foreach ($vacante->beneficios as $beneficio)
        <li>{{ $beneficio}}</li>
        @endforeach
        @endif
      </ul>
      <h1>Salario</h1>
      <ul>
          {{$vacante->salario}}
      </ul>
    </div>
  </div>

  <div class="right-section-alt">
      <div class="form-container-alt">
          <div class="form-header-alt">
              <h2>Únete al Equipo</h2>
              <img src="/imagenes/logo3.png" alt="Sky Free Shop" class="logo-sm">
            </div>

    <form class="alt-form" action="{{ route('postular.store', $vacante->slug) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="field">
        <input type="text" id="nombre" name="nombre" placeholder=" " required>
        <label for="nombre">Nombre completo</label>
      </div>

      <div class="field">
        <input type="email" id="email" name="email" placeholder=" " required>
        <label for="email">Correo electrónico</label>
      </div>
      <div class="field">
        <input  id="celular" name="celular" placeholder=" " required>
        <label >N° Celular</label>
      </div><div class="form-check consent my-3">
  <input
    class="form-check-input"
    type="checkbox"
    id="autorizacion"
    name="autorizacion"
    value="1"
    required
  >
  <label class="form-check-label" for="autorizacion">
    Autorizo a <strong>Sky Free Shop</strong> para el tratamiento de mis datos personales
    de acuerdo con la <a href="" target="_blank">Política de Tratamiento de Datos</a>
    y la Ley 1581 de 2012.
  </label>
</div>


      <div class="field">
  <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
  <label for="cv">Sube tu hoja de vida</label>
</div>


      <button type="submit" class="btn-alt">Enviar Solicitud</button>
    </form>
  </div>
</div>


</body>
</html>
