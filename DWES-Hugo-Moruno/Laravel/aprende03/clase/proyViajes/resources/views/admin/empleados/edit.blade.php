@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Empleado</h1>
        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('empleados.form')
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
@endsection
