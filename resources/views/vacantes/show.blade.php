@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
    }


    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
        font-size: 28px;
        text-align: center;
    }

    p {
        font-size: 16px;
        margin-bottom: 10px;
        color: #555;
    }

    strong {
        color: #000;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        background-color: #840028;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #a73a54;
    }

    @media screen and (max-width: 600px) {
        .navbar nav a {
            display: block;
            margin: 5px 0;
        }

        .container {
            margin: 20px;
        }
    }
</style>



<div class="container">
    <h1>{{ $vacante->titulo }}</h1>

    <p><strong>Descripción:</strong> {{ $vacante->descripcion }}</p>

    <form method="POST" action="{{ route('postular.store', $vacante->slug) }}" enctype="multipart/form-data">
        @csrf
        <input name="nombre" type="text" placeholder="Nombre" required />
        <input name="email" type="email" placeholder="Email" required />
        <input name="cv" type="file" required />
        <button type="submit">📤 Enviar hoja de vida</button>
    </form>
</div>

@endsection
