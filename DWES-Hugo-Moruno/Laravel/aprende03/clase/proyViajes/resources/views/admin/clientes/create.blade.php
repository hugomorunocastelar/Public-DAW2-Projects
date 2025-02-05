{{-- resources/views/admin/clientes/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Cliente</h1>
        <form action="{{ route('admin.clientes.store') }}" method="POST">
            @include('partials.form')
        </form>
    </div>
@endsection
