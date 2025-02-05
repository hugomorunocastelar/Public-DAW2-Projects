<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Crear Cliente') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.clientes.store') }}" method="POST">
            @csrf
            @include('admin.clientes.partials.form')
        </form>
    </div>
</x-app-layout>
