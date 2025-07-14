    @extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
        margin-bottom: 200px;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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

    a {
        color: #840028;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
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
    .toggle-button {
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f0f0f0;
  color: #333;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.toggle-button.active {
  background-color: #4CAF50; /* Color verde cuando está activado */
  color: white;
  border-color: #4CAF50;
}
/* Estilos generales para los iconos de acción (Aprobar/Rechazar) */
.action-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px; /* Tamaño del "botón" circular */
    height: 35px; /* Tamaño del "botón" circular */
    border-radius: 50%; /* Hace el elemento circular */
    text-decoration: none; /* Quita el subrayado por defecto en los enlaces */
    margin: 0 5px; /* Espacio entre los iconos */
    font-size: 1.2em; /* Tamaño del icono/emoji */
    cursor: pointer; /* Indica que es clickeable */
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease; /* Animaciones suaves */
    text-decoration: none; /* Quita el subrayado por defecto en los enlaces */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra sutil para profundidad */
}

/* Estilos específicos para el icono de APROBAR */
.action-icon--approve {
    background-color: #e6ffe6; /* Fondo verde muy claro */
    color: #28a745; /* Color del icono verde */
    border: 1px solid #28a745; /* Borde del mismo color */
}

.action-icon--approve:hover {
    background-color: #28a745; /* Fondo verde sólido al pasar el ratón */
    color: white; /* Icono blanco al pasar el ratón */
    transform: translateY(-2px); /* Pequeño levantamiento */
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3); /* Sombra más pronunciada */
    text-decoration: none; /* Quita el subrayado por defecto en los enlaces */

}

/* Estilos específicos para el icono de RECHAZAR */
.action-icon--reject {
    background-color: #ffe6e6; /* Fondo rojo muy claro */
    color: #dc3545; /* Color del icono rojo */
    border: 1px solid #dc3545; /* Borde del mismo color */
}

.action-icon--reject:hover {
    background-color: #dc3545; /* Fondo rojo sólido al pasar el ratón */
    color: white; /* Icono blanco al pasar el ratón */
    transform: translateY(-2px); /* Pequeño levantamiento */
    text-decoration: none; /* Quita el subrayado por defecto en los enlaces */
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3); /* Sombra más pronunciada */
}

</style>

<div style="display: flex; justify-content: flex-end; margin-top: 20px;">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
Filtrar
    </button>
</div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>CV</th>
                <th>Acciones</th>
                <th>Aprobado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
            @if ($candidato->estado === 'aprobado')
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
                        <a href="{{ route('candidatos.edit', $candidato) }}">✏️ Editar</a> |
                        <form action="{{ route('candidatos.destroy', $candidato) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este candidato?')" type="submit">🗑️ Eliminar</button>
                        </form>
                    </td>
                    <td>
<!-- AHORA (POST, SÍ FUNCIONA) -->
<form action="{{ route('candidatos.aprobar', $candidato->id) }}" method="POST" style="display:inline">
    @csrf
    <button type="submit"
            class="action-icon action-icon--approve"
            title="Aprobar Candidato">
        ✅
    </button>
</form>

        <a href="{{ route('candidatos.edit', $candidato) }}" class="action-icon action-icon--reject" title="Rechazar Candidato">
            <span class="icon">❌</span>
        </a>
                    </td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="max-width: 350px;">
    <div class="offcanvas-header" style="background-color: #840028; color: #fff;">
        <h5 class="offcanvas-title" id="offcanvasRightLabel" style="font-weight: bold;">Filtrar Candidatos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
        <div class="offcanvas-body" style="padding: 24px 18px;">
        <!-- Filtros por Cargo -->
        <div style="margin-bottom: 24px;">
            <h6 style="font-weight: bold; color: #840028;">Cargos</h6>
            <button class="toggle-button {{ data_get($initialToggles, 'contador', false) ? 'active' : '' }}" id="myToggleButton" style="width: 100%; margin-bottom: 10px;">Contador</button>
            <button class="toggle-button {{ data_get($initialToggles, 'cajero', false) ? 'active' : '' }}" id="ToggleButtoncajero" style="width: 100%; margin-bottom: 10px;">Cajero</button>
            <button class="toggle-button {{ data_get($initialToggles, 'ventas', false) ? 'active' : '' }}" id="ToggleButtonventas" style="width: 100%; margin-bottom: 10px;">Ventas</button>
        </div>
        <!-- Filtros por Habilidades -->
        <div style="margin-bottom: 24px;">
            <h6 style="font-weight: bold; color: #840028;">Habilidades</h6>
            <!-- Aquí puedes agregar más botones o checkboxes para habilidades -->
            <span style="color: #888;">(Próximamente)</span>
        </div>
        <!-- Filtros por Títulos -->
        <div style="margin-bottom: 24px;">
            <h6 style="font-weight: bold; color: #840028;">Títulos</h6>
            <!-- Aquí puedes agregar más botones o checkboxes para títulos -->
            <span style="color: #888;">(Próximamente)</span>
        </div>
        <button onclick="enviarFormulario()" class="btn" style="background-color: #840028; color: #fff; width: 100%; font-weight: bold;">Aplicar Filtros</button>
    </div>
@endsection
