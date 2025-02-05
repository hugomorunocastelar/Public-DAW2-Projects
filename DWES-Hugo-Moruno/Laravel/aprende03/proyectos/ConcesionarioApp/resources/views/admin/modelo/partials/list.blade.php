<div class="flex justify-between my-3">
    <h3 class="text-lg font-bold mb-4">Lista de Modelos</h3>
    <a href="{{ route('admin.modelos.index') }}">
        <x-buttons.button-edit/>
    </a>
</div>
@if($modelos->isEmpty())
    <p>No hay modelos registrados.</p>
@else
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Nombre</th>
            <th class="border border-gray-300 px-4 py-2">Tipo</th>
            <th class="border border-gray-300 px-4 py-2">Año</th>
            <th class="border border-gray-300 px-4 py-2">Marca</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($modelos as $modelo)
            <tr class="border border-gray-300">
                <td class="px-4 py-2 text-center">{{ $modelo->identificador }}</td>
                <td class="px-4 py-2">{{ $modelo->nombre }}</td>
                <td class="px-4 py-2">{{ $modelo->tipo }}</td>
                <td class="px-4 py-2">{{ $modelo->anho}}</td>
                <td class="px-4 py-2">{{ $modelo->marca ? $modelo->marca->nombre : 'Marca no disponible' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
