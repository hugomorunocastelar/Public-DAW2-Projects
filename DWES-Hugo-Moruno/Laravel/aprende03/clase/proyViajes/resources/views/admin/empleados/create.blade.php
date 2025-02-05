@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nuevo Empleado</h1>
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf
            @include('empleados.form')
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
@endsection
