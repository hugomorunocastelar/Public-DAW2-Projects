<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viajes admin') }}
        </h2>
    </x-slot>

    @include('viajes.index', ['viajes' => $viajes])
</x-app-layout>
