<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes admin') }}
        </h2>
    </x-slot>

    <a href="{{route('admin.clientes.create')}}">
        <x-button.btn-add/>
    </a>

    @include('clientes.index', ['clientes' => $clientes])
</x-app-layout>
