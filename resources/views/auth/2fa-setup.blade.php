@extends('layouts.app')

@section('content')
    <h2>Configurar Google Authenticator</h2>
    <p>Escanea este QR en Google Authenticator y luego ingresa el código de 6 dígitos cuando hagas login.</p>

    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
@endsection
