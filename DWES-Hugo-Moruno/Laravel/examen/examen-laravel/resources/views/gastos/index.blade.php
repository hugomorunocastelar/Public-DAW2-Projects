<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Administrar Gastos') }}
        </div>
    </x-slot>

    <div class="container mx-auto px-8 py-4">
        <div class="bg-gray-200 rounded-lg shadow-lg p-4 mb-6 flex justify-between">
            <h1 class="text-2xl font-bold text-blue-900 mb-4">Lista de Gastos</h1>
            <a href="{{ route('gastos.create') }}">
                <x-buttons.button-add/>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @include('gastos.partials.list')
        </div>
    </div>
</x-app-layout>
