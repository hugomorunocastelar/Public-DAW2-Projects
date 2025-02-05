<div class="flex justify-between my-3">
    <h3 class="text-lg font-bold mb-4">Lista de Marcas</h3>
    <a href="{{ route('admin.marcas.index') }}">
        <x-buttons.button-edit/>
    </a>
</div>
@if($marcas->isEmpty())
    <p>No hay marcas registradas.</p>
@else
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Nombre</th>
            <th class="border border-gray-300 px-4 py-2">País de Origen</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($marcas as $marca)
            <tr class="border border-gray-300">
                <td class="px-4 py-2 text-center">{{ $marca->id }}</td>
                <td class="px-4 py-2">{{ $marca->nombre }}</td>
                <td class="px-4 py-2">{{ $marca->pais_origen }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
