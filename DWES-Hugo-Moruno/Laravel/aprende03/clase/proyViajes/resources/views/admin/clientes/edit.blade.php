{{-- resources/views/admin/clientes/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Cliente</h1>
        <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
            @method('PUT')
            @include('partials.form')
        </form>
    </div>
@endsection
