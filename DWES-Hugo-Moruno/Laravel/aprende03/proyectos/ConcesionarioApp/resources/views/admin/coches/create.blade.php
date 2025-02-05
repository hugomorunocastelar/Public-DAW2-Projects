<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            {{ __('Crear Coche') }}
        </div>
    </x-slot>

    <div class="container mx-auto my-5">
        <form action="{{ route('admin.coches.store') }}" method="POST">
            @csrf
            @include('admin.coches.partials.form')
        </form>
    </div>
</x-app-layout>
