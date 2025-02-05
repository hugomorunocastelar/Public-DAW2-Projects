<x-app-layout>
    <x-slot name="header">
        ADMINISTRACIÓN DE ARTÍCULOS
    </x-slot>

    <a href="{{ route('admin.articulos.create') }}"
        class="m-4 border border-teal-800 bg-teal-300 rounded shadow hover:ring-2 hover:ring-amber-200 px-2 py-1 text-white">Nuevo</a>
    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-lime-200">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-amber-200 text-black">
                    <th class="px-4 py-2">Referencia</th>
                    <th class="text-left px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                <tr>
                    <td class="text-center border-b border-gray-300 px-4 py-2">{{ $articulo->ref }}</td>
                    <td class="text-left border-b border-gray-300 px-4 py-2">{{ $articulo->descripcion }}</td>
                    <td class="text-right border-b border-gray-300 px-4 py-2">{{ $articulo->precio }}€</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>