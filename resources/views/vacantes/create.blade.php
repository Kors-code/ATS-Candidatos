@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9f9f9;
        margin: 0;
    }

   
    .container {
        max-width: 700px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        margin-top: 15px;
    }

    input[type="text"], textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #840028;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background-color: #a83644;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    @media (max-width: 600px) {
        .navbar nav a {
            display: block;
            margin: 5px 0;
        }
    }
</style>
<a href="{{ url()->previous() }}" style="display: inline-block; margin-top: 20px; background-color: #840028; color: #fff; padding: 8px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background 0.2s;">
    ← Volver
</a>

<div class="container">
    <h1>Crear Vacante</h1>
    @if ($errors->any())
        <div class="alert alert-danger" style="color: #a94442; background: #f2dede; border: 1px solid #ebccd1; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
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

    <form method="POST" action="{{ route('vacantes.store') }}">
        @csrf
        <label>Título:</label>
        <input type="text" name="titulo" required>

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4"></textarea>

        <label>Palabras clave (separadas por coma):</label>
        <input type="text" name="palabras_clave" required>

        <button type="submit">Guardar Vacante</button>
    </form>
</div>
@endsection
