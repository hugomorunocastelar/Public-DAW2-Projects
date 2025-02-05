    <x-app-layout>
        <x-slot name="header">
            ADMINISTRACIÓN DE ARTÍCULOS - NUEVO ARTICULO
        </x-slot>
    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
        <form action="{{route('admin.articulos.store')}}" method="post">
            @csrf
            Referencia: <input type="text" name="ref" placeholder="referencia" class="w-full px-2 py-1">
            Descripción: <input type="text" name="descripcion" placeholder="descripcion" class="w-full px-2 py-1">
            Precio: <input type="text" name="precio" placeholder="precio" class="w-full px-2 py-1">
            Observaciones: <input type="text" name="Observaciones" placeholder="Observaciones" class="w-full px-2 py-1">
            <input type="submit" value="Guardar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">

        </form>
    </div>
    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
        <ul>
            @foreach ($articulos as $articulo)
            <li>{{ $articulo->ref }} - {{$articulo->descripcion}}</li>
            @endforeach
        </ul>
    </div>
    
    
    </x-app-layout>
