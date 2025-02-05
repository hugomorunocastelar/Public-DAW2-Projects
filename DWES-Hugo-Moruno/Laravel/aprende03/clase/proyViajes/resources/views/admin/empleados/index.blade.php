@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Empleados</h1>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Nuevo Empleado</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>NIF</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nif }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->apellido1 }}</td>
                    <td>{{ $empleado->apellido2 }}</td>
                    <td>{{ $empleado->active ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
