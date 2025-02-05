<x-app-layout>
    <x-slot name="header">
        ADMINISTRACIÓN DE PROVEEDORES
    </x-slot>
    <a href="{{ route('admin.proveedores.create') }}">
        <x-button.new-button />
    </a>

    @include('admin.proveedores.partials.list')
</x-app-layout>
