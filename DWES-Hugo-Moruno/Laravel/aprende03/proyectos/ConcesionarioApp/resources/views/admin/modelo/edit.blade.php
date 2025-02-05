<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Editar Modelo') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.modelos.update', $modelo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.modelo.partials.form', [
                'readonly' => false,
                'submit' => true
            ])
        </form>
    </div>
</x-app-layout>
