<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes guest') }}
        </h2>
    </x-slot>

    @include('clientes.index', ['clientes' => $clientes])

</x-app-layout>
