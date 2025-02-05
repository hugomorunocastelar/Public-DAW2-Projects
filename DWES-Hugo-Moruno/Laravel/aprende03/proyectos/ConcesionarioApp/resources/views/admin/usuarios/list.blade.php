<div class="flex justify-between my-3">
    <h3 class="text-lg font-bold mb-4">Lista de Usuarios</h3>
</div>
@if($usuarios->isEmpty())
    <p>No hay usuarios registrados.</p>
@else
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Nombre</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Role</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($usuarios as $usuario)
            <tr class="border border-gray-300">
                <td class="px-4 py-2 text-center">{{ $usuario->id }}</td>
                <td class="px-4 py-2">{{ $usuario->name }}</td>
                <td class="px-4 py-2">{{ $usuario->email }}</td>
                <td class="px-4 py-2 text-center">{{ $usuario->getRoleNames() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
