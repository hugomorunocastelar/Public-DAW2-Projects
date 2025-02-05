<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Detalles de la Marca') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        @include('admin.marcas.partials.form',
                    ['title' => __('Ver Cliente'),
                    'readonly' => true,
                    'submit' => false]);
    </div>
</x-app-layout>
