<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Editar Marca') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.marcas.update', $marca->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.marcas.partials.form', ['item' => $marca])
        </form>
    </div>
</x-app-layout>
