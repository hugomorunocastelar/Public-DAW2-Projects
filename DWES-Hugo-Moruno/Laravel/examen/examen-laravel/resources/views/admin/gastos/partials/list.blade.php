<table class="w-full border-collapse">
    <thead class="bg-gray-300">
    <tr>
        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Concepto</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Descripcion</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Fecha</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Gasto</th>
        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Usuario</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($gastos as $gasto)
        <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $gasto->conceptos_id }}</td>
            <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $gasto->concepto->descripcion ?? ''}}</td>
            <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $gasto->fecha }}</td>
            <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $gasto->gasto }}</td>
            <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $gasto->user_id }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
