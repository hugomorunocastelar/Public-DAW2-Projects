<x-app-layout>
    <x-slot name="header">
        ADMINISTRACIÓN DE PROVEEDORES - CONSULTA PROVEEDOR
    </x-slot>
    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">

            {{-- @include('admin.proveedores.partials.form', ['readonly'=>'readonly']) --}}
            @include('admin.proveedores.partials.form', ['readonly'=>true])
            {{-- <x-button.save-form-button title="Guardar" /> --}}
    </div>

</x-app-layout>
