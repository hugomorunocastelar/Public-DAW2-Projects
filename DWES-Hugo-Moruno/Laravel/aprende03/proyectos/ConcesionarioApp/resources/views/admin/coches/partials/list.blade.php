<div class="flex justify-between my-3">
    <h3 class="text-lg font-bold mb-4">Lista de Coches</h3>
    <a href="{{ route('admin.coches.index') }}">
        <x-buttons.button-edit/>
    </a>
</div>
@if($coches->isEmpty())
    <p>No hay coches registrados.</p>
@else
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">Matrícula</th>
            <th class="border border-gray-300 px-4 py-2">Color</th>
            <th class="border border-gray-300 px-4 py-2">Vendido</th>
            <th class="border border-gray-300 px-4 py-2">Cliente</th>
            <th class="border border-gray-300 px-4 py-2">Modelo</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($coches as $coche)
            <tr class="border border-gray-300">
                <td class="px-4 py-2">{{ $coche->matricula }}</td>
                <td class="px-4 py-2">{{ $coche->color }}</td>
                <td class="px-4 py-2">{{ $coche->vendido ? 'Si' : 'No' }}</td>
                <td class="px-4 py-2">{{ $coche->cliente->nombre ?? '------------' }}</td>
                <td class="px-4 py-2">{{ $coche->modeloCoche->nombre ?? '!! MODELO RETIRADO !!' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
