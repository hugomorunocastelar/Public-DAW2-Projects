<x-guest-layout>
    <x-slot name="header">
        HOLA
    </x-slot>

    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
        <h2 class="text-xl font-semibold mb-4">Lista de Articulos</h2> <!-- Título para la sección -->
        @foreach ($articulos as $articulo)
            <ul class="py-2 border-b border-blue-600">
                <li>{{ $articulo->ref }}</li>
                <li>{{ $articulo->descripcion }} </li>
                <li>{{ $articulo->precio }}€</li>
            </ul>
        @endforeach

    </div>
    <x-slot name="footer">
        &copy; 2024 DWES - IES CASTELAR
    </x-slot>
</x-guest-layout>
