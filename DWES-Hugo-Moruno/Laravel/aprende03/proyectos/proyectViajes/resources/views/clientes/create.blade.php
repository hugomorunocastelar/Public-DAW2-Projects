<x-app-layout>
    <x-slot name="header">
        NUEVO CLIENTE
    </x-slot>
    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
        <form action="{{ route('admin.clientes.store') }}" method="post">
            @csrf
            @include('clientes.partials.form')
            <x-button.btn-save/>
        </form>
    </div>
    @include('clientes.partials.list')

</x-app-layout>
