<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Crear gasto') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('gastos.store', $gasto) }}" method="POST">
            @csrf
            @include('gastos.partials.form')
        </form>
    </div>
</x-app-layout>
