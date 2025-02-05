<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Detalles del Modelo') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        @include('admin.modelo.partials.form',
                    ['readonly' => true,
                    'submit' => false]);
    </div>
</x-app-layout>
