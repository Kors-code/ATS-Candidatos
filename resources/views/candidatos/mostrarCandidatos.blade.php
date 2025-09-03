@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/candidatosmostrarcandidatos.css') }}">


<a href="{{ url()->previous() }}" class="volver">
    ← Volver
</a>
<div class="container">

    <h1>Lista de Candidatos</h1>

    <a  class="btn-nuevo" style="text-decoration: none;" href="{{ route('vacantes.index') }}">➕ Nuevo Candidato</a>

    <ul class="vacante-lista ">
        @foreach ($vacantes as $vacante)
            <li>
                <a class="{{$vacante->habilitado ? '': 'vacante-deshabilitada'}}" href="{{ route('candidatos.show', $vacante->slug) }}">                    {{ $vacante->titulo }}
                </a>
            </li>
        @endforeach
        <li>
            <a href="{{ route('candidatos.index') }}">
                <strong>Todos los candidatos</strong>
            </a>
        </li>
    </ul>

    <form class="form-inline" method="GET" action="{{ route('panel.candidatos') }}">
        <input name="q" value="{{ request('q') }}" placeholder="Buscar vacante" />
        <button type="submit">Buscar</button>
    </form>

</div>

@endsection
