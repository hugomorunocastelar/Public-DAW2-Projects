<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Administrar Modelos de Coche') }}
        </div>
    </x-slot>

    <div class="container mx-auto px-8 py-4">
        <div class="bg-gray-200 rounded-lg shadow-lg p-4 mb-6 flex justify-between">
            <h1 class="text-2xl font-bold text-blue-900 mb-4">Lista de Modelos de Coche</h1>
            <a href="{{ route('admin.modelos.create') }}">
                <x-buttons.button-add/>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-300">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Nombre</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Tipo</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Año</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Marca</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Descontinuado</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-blue-900">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($modelos as $modelo)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $modelo->nombre }}</td>
                        <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $modelo->tipo }}</td>
                        <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $modelo->anho }}</td>
                        <td class="px-4 py-2 border-t text-sm text-gray-700">{{ $modelo->marca->nombre }}</td>
                        <td class="px-4 py-2 border-t text-sm text-gray-700">
                            <input type="checkbox" disabled {{ $modelo->descontinuado ? 'checked' : '' }} />
                        </td>
                        <td class="px-4 py-2 border-t text-sm text-gray-700 flex space-x-2">
                            <a href="{{ route('gastos.show', $modelo->identificador) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">
                                Ver
                            </a>
                            <a href="{{ route('gastos.edit', $modelo->identificador) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600">
                                Editar
                            </a>
                            <form action="{{ route('gastos.destroy', $modelo->identificador) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
