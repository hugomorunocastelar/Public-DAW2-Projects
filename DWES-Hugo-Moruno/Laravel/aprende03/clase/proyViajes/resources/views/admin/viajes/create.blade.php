@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nuevo Viaje</h1>
        <form action="{{ route('viajes.store') }}" method="POST">
            @csrf
            @include('viajes.form')
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
@endsection
