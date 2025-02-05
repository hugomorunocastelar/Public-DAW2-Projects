<x-guest-layout>
    <x-slot name="header">
        HOLA
    </x-slot>
    <div class="m-4 p-8 rounded-lg shadow border border-fuchsia-600 bg-amber-200">
        <h2 class="text-xl font-semibold mb-4">Lista de Proveedores</h2> <!-- Título para la sección -->
        <ul class="list-disc list-inside"> <!-- Estilo de lista -->
            @foreach ($proveedores as $proveedor)
                <ul class="py-2 border-b border-blue-600">
                    <li>{{ $proveedor->nif }}</li>
                    <li>{{ $proveedor->razon_social }}</li>
                </ul>
            @endforeach
        </ul>
    </div>
    <x-slot name="footer">
        &copy; 2024 DWES - IES CASTELAR
    </x-slot>
</x-guest-layout>
