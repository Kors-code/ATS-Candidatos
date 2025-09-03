@extends('layouts.app')

@section('content')
    <h2>Autenticación en dos pasos (2FA por Email)</h2>

    {{-- Botón para pedir OTP --}}
    <form action="{{ route('email2fa.setup.post') }}" method="POST">
        @csrf
        <button type="submit">Pedir OTP</button>
    </form>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- Formulario para ingresar OTP --}}
    <form action="{{ route('email2fa.verify.post') }}" method="POST">
        @csrf
        <label for="code">Ingresa el código recibido:</label>
        <input type="text" name="code" id="code" maxlength="6" required>
        <button type="submit">Verificar</button>
    </form>

    @error('code')
        <p style="color:red;">{{ $message }}</p>
    @enderror
@endsection
