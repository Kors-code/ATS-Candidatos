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

   .custom-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 30px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.5s ease-out;
}

.custom-table thead {
    background-color: #840028;
    color: #fff;
    text-transform: uppercase;
}

.custom-table th,
.custom-table td {
    padding: 16px 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
    transition: background-color 0.3s ease;
}

.custom-table tbody tr:hover {
    background-color: #f1f1f1;
    transform: scale(1.005);
    transition: transform 0.2s ease-in-out;
}

.custom-table tbody tr.table-success {
    background-color: #e6ffee !important;
}

.custom-table tbody tr.table-danger {
    background-color: #ffe6e6 !important;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
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
.table-success{
    background-color: #d4edda !important;
}
.table-danger{
    background-color: #f8d7da !important;
    
}
</style>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="{{ route('panel.candidatos') }}" style="display: inline-block; margin-top: 20px; background-color: #840028; color: #fff; padding: 8px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background 0.2s;">
    ← Volver
</a>

<a href="{{ route('candidatos.aprobados.list', $vacante->slug) }}" style="...">
    Aprobados
</a>
<a href="{{ route('candidatos.rechazados.list', $vacante->slug) }}" style="...">
    rechazados
</a>

<div style="display: flex; justify-content: flex-end; margin-top: 20px;">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
Filtrar
    </button>
</div>
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
</div>
<div class="container">
    <h1>Listado de Candidatos</h1>

    <form class="form-inline" id="form" method="GET" action="{{ route('candidatos.show', $vacante->slug) }}">
        <input name="q" value="{{ request('q') }}" />
        <input name="contador" id="contador" value="{{ request('contador') }}" type="hidden"/>
        <input name="cajero" id="cajero" value="{{ request('cajero') }}" type="hidden" />
        <input name="ventas" id="ventas" value="{{ request('ventas') }}" type="hidden" />
        <button type="submit">Buscar</button>
    </form>
    <table class="custom-table">
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
                <tr class="{{ $candidato->estado === 'aprobado' ? 'table-success' : ($candidato->estado === 'rechazado' ? 'table-danger' : '') }}">
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
<form action="{{ route('candidatos.aprobar', $candidato->id) }}" method="POST" style="display:inline">
    @csrf
    <button type="submit"
            class="action-icon action-icon--approve"
            title="Aprobar Candidato">
        ✅
    </button>
</form>
<form action="{{ route('candidatos.rechazar', $candidato->id) }}" method="POST" style="display:inline">
    @csrf
    <button type="submit"
            class="action-icon action-icon--approve"
            title="Rechazar Candidato">
        ❌
    </button>
</form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
  // Función que guarda un toggle concreto en sesión
  function saveToggle(key, value) {
    return fetch('{{ route('toggle.store') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ key: key, value: value })
    });
  }

  // Envía todos los toggles y luego el form
  function enviarFormulario() {
    // Leer estados reales de los botones (IDs reales en tu HTML)
    const contadorOn = document.getElementById('myToggleButton').classList.contains('active');
    const cajeroOn   = document.getElementById('ToggleButtoncajero').classList.contains('active');
    const ventasOn   = document.getElementById('ToggleButtonventas').classList.contains('active');

    // Actualiza los inputs ocultos
    document.getElementById('contador').value = contadorOn ? '1' : '0';
    document.getElementById('cajero').value   = cajeroOn   ? '1' : '0';
    document.getElementById('ventas').value   = ventasOn   ? '1' : '0';

    // Envía en paralelo los 3 toggles
    Promise.all([
      saveToggle('contador', contadorOn),
      saveToggle('cajero',   cajeroOn),
      saveToggle('ventas',   ventasOn),
    ]).then(() => {
      // Cuando terminen, envía el formulario
      document.getElementById('form').submit();
    }).catch(err => {
      console.error('Error guardando toggles:', err);
      // Aun así enviamos el formulario
      document.getElementById('form').submit();
    });
  }

  // Solo togglea la clase active al hacer click
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('myToggleButton').addEventListener('click', function() {
      this.classList.toggle('active');
    });
    document.getElementById('ToggleButtoncajero').addEventListener('click', function() {
      this.classList.toggle('active');
    });
    document.getElementById('ToggleButtonventas').addEventListener('click', function() {
      this.classList.toggle('active');
    });
  });
</script>

@endsection
