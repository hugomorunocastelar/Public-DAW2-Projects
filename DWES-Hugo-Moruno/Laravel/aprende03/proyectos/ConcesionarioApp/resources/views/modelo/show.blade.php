<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detalles del Modelo:') }} <span class="text-blue-600">{{ $modelo->nombre }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <!-- Título -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Detalles del Modelo de Coche</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <!-- Nombre -->
                    <div class="mb-4">
                        <p class="text-gray-600 text-lg">
                            <strong class="text-blue-700">Nombre:</strong>
                            <span class="text-gray-900">{{ $modelo->nombre }}</span>
                        </p>
                    </div>

                    <!-- Tipo -->
                    <div class="mb-4">
                        <p class="text-gray-600 text-lg">
                            <strong class="text-blue-700">Tipo:</strong>
                            <span class="text-gray-900">{{ $modelo->tipo ?? 'No especificado' }}</span>
                        </p>
                    </div>

                    <!-- Año -->
                    <div class="mb-4">
                        <p class="text-gray-600 text-lg">
                            <strong class="text-blue-700">Año:</strong>
                            <span class="text-gray-900">{{ $modelo->anho }}</span>
                        </p>
                    </div>

                    <!-- Marca -->
                    <div class="mb-4">
                        <p class="text-gray-600 text-lg">
                            <strong class="text-blue-700">Marca:</strong>
                            <span class="text-gray-900">{{ $modelo->marca ? $modelo->marca->nombre : 'Marca no disponible' }}</span>
                        </p>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-4">
                        <p class="text-gray-600 text-lg">
                            <strong class="text-blue-700">Imagen:</strong>
                        </p>
                        <div class="mt-2">
                            @if ($modelo->imagen)
                                <img src="{{ asset('storage/private/' . $modelo->imagen) }}" alt="Imagen del modelo" class="w-full h-auto object-cover rounded-lg shadow-md">
                            @else
                                <p class="text-gray-500">No hay imagen disponible.</p>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('marcas') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
