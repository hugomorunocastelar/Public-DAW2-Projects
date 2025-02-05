{{-- resources/views/admin/clientes/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalle del Cliente</h1>
        <p><strong>ID:</strong> {{ $cliente->id }}</p>
        <p><strong>NIF:</strong> {{ $cliente->nif }}</p>
        <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
        <p><strong>Apellido1:</strong> {{ $cliente->apellido1 }}</p>
        <p><strong>Apellido2:</strong> {{ $cliente->apellido2 ?? '-' }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $cliente->fecha_nacimiento ?? '-' }}</p>
        <p><strong>Foto:</strong> {{ $cliente->foto ?? '-' }}</p>
        <p><strong>Observaciones:</strong> {{ $cliente->observaciones ?? '-' }}</p>
        <p><strong>Activo:</strong> {{ $cliente->active ? 'Sí' : 'No' }}</p>
        <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
