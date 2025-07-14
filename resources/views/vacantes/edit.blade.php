@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Vacante</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vacantes.update', $vacante->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $vacante->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $vacante->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="palabras_clave" class="form-label">Palabras clave</label>
            <input type="text" name="palabras_clave" id="palabras_clave" class="form-control" value="{{ old('palabras_clave', $vacante->palabras_clave ?? '') }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('vacantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection