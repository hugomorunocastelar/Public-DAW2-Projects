@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Viaje</h1>
        <form action="{{ route('viajes.update', $viaje->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('viajes.form')
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
@endsection
