<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Crear Marca') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.marcas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.marcas.partials.form')
        </form>
    </div>
</x-app-layout>
