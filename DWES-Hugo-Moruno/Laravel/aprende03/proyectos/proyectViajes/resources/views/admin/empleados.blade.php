<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empleados admin') }}
        </h2>
    </x-slot>

    @include('empleados.index', ['empleados' => $empleados])
</x-app-layout>
