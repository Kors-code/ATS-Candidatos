<h1>Editar Candidato</h1>

<form method="POST" action="{{ route('candidatos.update', $candidato) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input name="nombre" value="{{ $candidato->nombre }}" placeholder="Nombre" /><br>
    <input name="email" type="email" value="{{ $candidato->email }}" placeholder="Email" /><br>

    <label>Nuevo CV (opcional):</label>
    <input name="cv" type="file" /><br>

    <button type="submit">Actualizar</button>
</form>
