<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Crear Modelo') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.modelos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.modelo.partials.form')
        </form>
    </div>
</x-app-layout>
