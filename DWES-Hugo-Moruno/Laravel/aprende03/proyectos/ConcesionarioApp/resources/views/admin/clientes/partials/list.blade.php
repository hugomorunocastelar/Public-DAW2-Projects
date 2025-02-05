<div class="flex justify-between my-3">
    <h3 class="text-lg font-bold mb-4">Lista de Clientes</h3>
    <a href="{{ route('admin.clientes.index') }}">
        <x-buttons.button-edit/>
    </a>

</div>
@if($clientes->isEmpty())
    <p>No hay clientes registrados.</p>
@else
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Nombre</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Teléfono</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
            <tr class="border border-gray-300">
                <td class="px-4 py-2 text-center">{{ $cliente->id }}</td>
                <td class="px-4 py-2">{{ $cliente->nombre }}</td>
                <td class="px-4 py-2">{{ $cliente->email }}</td>
                <td class="px-4 py-2">{{ $cliente->telefono ?? 'N/A' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
