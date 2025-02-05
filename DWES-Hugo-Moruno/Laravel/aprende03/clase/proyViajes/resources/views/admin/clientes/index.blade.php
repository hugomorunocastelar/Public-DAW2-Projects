{{-- resources/views/admin/clientes/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Clientes</h1>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary mb-3">Crear Cliente</a>

        @include('partials.list', ['items' => $clientes, 'routePrefix' => 'admin.clientes'])
    </div>
@endsection
