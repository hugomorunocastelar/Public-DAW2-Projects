<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Detalles del Coche') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        @include('admin.coches.partials.form',
                    ['title' => __('Ver Cliente'),
                    'readonly' => true,
                    'submit' => false]);
    </div>
</x-app-layout>
