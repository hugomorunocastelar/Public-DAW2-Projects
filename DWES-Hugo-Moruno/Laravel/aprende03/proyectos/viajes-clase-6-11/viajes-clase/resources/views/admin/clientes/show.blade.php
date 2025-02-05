<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Administración de clientes') }} - {{$cliente->nombre}} - {{$cliente->nif}}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-4">
                @include('admin.clientes.partials.form',
                    ['title' => __('Ver Cliente'),
                    'readonly' => true,
                    'submit' => false])
                @include('admin.clientes.partials.list')
            </div>
        </div>
    </div>
</x-guest-layout>
