<x-guest-layout>
    <x-slot name="header">
        Página de Artículos:
    </x-slot>
    <div class="m-4 p-8 rounded shadow bg-amber-200 border-4 border-b-gray-600">
        ARTICULOS:
        <ul>
            @foreach($articulos as $articulo)
                <p> {{ $articulo -> ref }} - {{ $articulo -> descripcion }}</p>
            @endforeach
        </ul>
    </div>
</x-guest-layout>
