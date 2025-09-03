@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/vacantecreate.css') }}">

<a href="{{ url()->previous() }}" class="volver">
    ← Volver
</a>

<div class="container">
    <h1>Crear Vacante</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

<form id="formulario">

</form>

    <form method="POST" action="{{ route('vacantes.store') }}">
        @csrf
        <label>Título:</label>
        <input type="text" name="titulo" required>
        
        <label>Descripción:</label>
        <textarea name="descripcion" rows="2"></textarea>
        
        <label>Requisito IA:</label>
        <input type="text" name="requisito_ia" required>
        </label>
        <label>Salario</label>
        <input type="text" name="salario" required>
        </label>
        <div id="contenedor-beneficios">
        <label>Beneficios</label>
        <input type="text" name="beneficios[]" required>
        </label>
            
        </div>
    <button type="button" id="btn-agregarbeneficio">➕ Añadir beneficio</button>
    <button type="button" id="btn-quitarbeneficio">➖​ Quitar beneficio</button>
        <div id="contenedor-requisitos">
        <div class="campo">
            <label>Requisitos</label>
            <input type="text" name="requisitos[]">
        </div>
    </div>

    <button type="button" id="btn-agregar">➕ Añadir Requisito</button>
    <button type="button" id="btn-quitar">➖​ Quitar Requisito</button>
    <br><br>
      <label for="ciudad">Selecciona una ciudad:</label>
    <select id="ciudad" name="localidad" required>
    <option value=""> Selecciona </option>
    <option value="Aeropuerto Internacional Jose Maria Cordoba">Aeropuerto Internacional Jose Maria Cordoba</option>
    <option value="Puerto de manga">Puerto de manga</option>
  </select>
        <h4>Criterios de Evaluación</h4>
<div class="criterio">
    <label>Inglés</label>
    <input type="number" name="criterios[ingles]" placeholder="Peso %" min="0" max="100" required>

    <label>Habilidades Blandas</label>
    <input type="number" name="criterios[habilidades]" placeholder="Peso %" min="0" max="100" required>

<div class="criterio">
    <label>Experiencia</label>
    <input type="number" name="criterios[experiencia]" placeholder="Peso %" min="0" max="100" required>
</div>

<div class="criterio">
    <label>Educación</label>
    <input type="number" name="criterios[educacion]" placeholder="Peso %" min="0" max="100" required>
</div>
    <button type="submit">✅ Enviar</button>
    </form>
</div>
<script src="{{ asset('js/añadirRequisitos.js') }}" defer></script>
@endsection
