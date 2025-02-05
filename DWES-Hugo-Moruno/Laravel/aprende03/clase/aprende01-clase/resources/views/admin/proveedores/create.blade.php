    <x-app-layout>
        <x-slot name="header">
            ADMINISTRACIÓN DE PROVEEDORES - NUEVO PROVEEDOR
        </x-slot>
        <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
            <form action="{{ route('admin.proveedores.store') }}" method="post">
                @csrf
                @include('admin.proveedores.partials.form')
                <x-button.save-form-button title="Guardar" />

            </form>
        </div>
        <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
            <ul>
                @foreach ($proveedores as $proveedor)
                    <li>{{ $proveedor->nif }} - {{ $proveedor->razon_social }}</li>
                @endforeach
            </ul>
        </div>


    </x-app-layout>
