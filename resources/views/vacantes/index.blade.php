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
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .btn-crear {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #840028;
        color: white;
        padding: 10px 16px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-crear:hover {
        background-color: #a73a54;
    }

    .vacantes-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        margin-top: 20px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(132,0,40,0.08);
        animation: fadeIn 0.8s;
    }
    .vacantes-table th, .vacantes-table td {
        padding: 14px 18px;
        text-align: left;
    }
    .vacantes-table th {
        background: #840028;
        color: #fff;
        font-weight: 600;
        border: none;
    }
    .vacantes-table tbody tr {
        background: #f7f7fa;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .vacantes-table tbody tr:hover {
        box-shadow: 0 4px 16px rgba(132,0,40,0.10);
        transform: scale(1.01);
        background: #fff0f5;
    }
    .vacante-link {
        color: #840028;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.2s;
    }
    .vacante-link:hover {
        color: #a73a54;
        text-decoration: underline;
    }
    .btn-editar, .btn-eliminar {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s, color 0.2s, transform 0.15s;
        text-decoration: none;
    }
    .btn-editar {
        background: #f5e1ea;
        color: #840028;
    }
    .btn-editar:hover {
        background: #e7c2d0;
        color: #a73a54;
        transform: translateY(-2px) scale(1.05);
    }
    .btn-eliminar {
        background: #ffeaea;
        color: #b30000;
    }
    .btn-eliminar:hover {
        background: #ffb3b3;
        color: #fff;
        transform: translateY(-2px) scale(1.05);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @media screen and (max-width: 600px) {
        .navbar nav a {
            display: block;
            margin: 5px 0;
        }
        .vacantes-table, .vacantes-table thead, .vacantes-table tbody, .vacantes-table th, .vacantes-table td, .vacantes-table tr {
            display: block;
        }
        .vacantes-table thead tr {
            display: none;
        }
        .vacantes-table td {
            position: relative;
            padding-left: 50%;
            margin-bottom: 10px;
        }
        .vacantes-table td:before {
            position: absolute;
            left: 18px;
            top: 14px;
            width: 45%;
            white-space: nowrap;
            font-weight: bold;
            color: #840028;
        }
        .vacantes-table td:nth-child(1):before { content: "Título"; }
        .vacantes-table td:nth-child(2):before { content: "Editar"; }
        .vacantes-table td:nth-child(3):before { content: "Eliminar"; }
    }



    .btn-crear {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #840028;
        color: white;
        padding: 10px 16px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-crear:hover {
        background-color: #a73a54;
    }

    .vacante-lista {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-bottom: 80px;
    }

    @media screen and (max-width: 600px) {
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
    <h1>Vacantes</h1>

    <a href="{{ route('vacantes.create') }}" class="btn-crear">➕ Crear nueva vacante</a>

    <ul class="vacante-lista">
        <table class="vacantes-table">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Palabras Clave</th>
                <th style="width: 110px;">Editar</th>
                <th style="width: 120px;">Eliminar</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vacantes as $vacante)
            <tr>
                <td>
                <a href="{{ route('vacantes.show', $vacante->slug) }}" class="vacante-link">
                    {{ $vacante->titulo }}
                </a>
                </td>
                <td>
                    {{ $vacante->descripcion }}
                </td>
                <td>
                    {{ $vacante->palabras_clave ?? 'N/A' }}
                </td>
                <td>
                <a href="{{ route('vacantes.edit', $vacante->slug) }}" class="btn-editar">✏️ Editar</a>
                </td>
                <td>
                <form action="{{ route('vacantes.destroy', $vacante->slug) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta vacante?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar">🗑️ Eliminar</button>
                </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>


    </ul>

</div>

@endsection
