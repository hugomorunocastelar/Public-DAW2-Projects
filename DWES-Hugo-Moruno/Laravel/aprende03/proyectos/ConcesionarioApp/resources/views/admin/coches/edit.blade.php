<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Editar Coche') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.coches.update', $coche->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.coches.partials.form')
        </form>
    </div>
</x-app-layout>
