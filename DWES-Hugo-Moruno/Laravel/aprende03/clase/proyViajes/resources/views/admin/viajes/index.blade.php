@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Viajes</h1>
        <a href="{{ route('viajes.create') }}" class="btn btn-primary mb-3">Nuevo Viaje</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Referencia</th>
                <th>Título</th>
                <th>Slug</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($viajes as $viaje)
                <tr>
                    <td>{{ $viaje->referencia }}</td>
                    <td>{{ $viaje->titulo }}</td>
                    <td>{{ $viaje->slug }}</td>
                    <td>{{ $viaje->precio }}</td>
                    <td>{{ $viaje->active ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('viajes.edit', $viaje->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('viajes.destroy', $viaje->id) }}" method="POST" style="display:inline-block;">
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
