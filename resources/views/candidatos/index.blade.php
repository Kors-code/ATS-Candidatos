@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9f9f9;
        margin: 0;
    }

    
    h1 {
        text-align: center;
        color: #333;
        margin-top: 20px;
    }

    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    a {
        color: #840028;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    .btn-nuevo {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #840028;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 12px 15px;
        border: 1px solid #ccc;
        text-align: left;
    }

    table thead {
        background-color: #840028;
        color: #fff;
    }

    .form-inline {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }

    .form-inline input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        min-width: 200px;
    }

    .form-inline button {
        background-color: #840028;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-inline button:hover {
        background-color: #a83644;
    }

    button[type="submit"] {
        background: none;
        border: none;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        text-decoration: underline;
    }

    @media screen and (max-width: 600px) {
        .navbar nav a {
            display: block;
            margin: 5px 0;
        }

        .form-inline {
            flex-direction: column;
        }
    }
</style>


<a href="{{ url()->previous() }}" style="display: inline-block; margin-top: 20px; background-color: #840028; color: #fff; padding: 8px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background 0.2s;">
    ← Volver
</a>
<div class="container">

    <h1>Lista de Candidatos</h1>

    <a class="btn-nuevo" href="{{ route('vacantes.index') }}">➕ Nuevo Candidato</a>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>CV</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
                <tr>
                    <td>{{ $candidato->nombre }}</td>
                    <td>{{ $candidato->email }}</td>
                    <td>
                        @if ($candidato->cv)
                            <a href="{{ asset('storage/' . $candidato->cv) }}" target="_blank">Ver CV</a>
                        @else
                            No enviado
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('candidatos.edit', $candidato) }}">✏️ Editar</a>
                        <form action="{{ route('candidatos.destroy', $candidato) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este candidato?')" type="submit">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form class="form-inline" method="GET" action="{{ route('candidatos.index') }}">
        <input name="q" value="{{ request('q') }}" placeholder="Buscar por experiencia o tecnología" />
        <button type="submit">Buscar</button>
    </form>

</div>

@endsection
