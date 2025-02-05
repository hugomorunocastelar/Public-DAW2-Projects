<x-app-layout>
    <div class="container">
        <h1>Detalles del Cliente</h1>
        @include('admin.clientes.partials.form',
                    ['title' => __('Ver Cliente'),
                    'readonly' => true,
                    'submit' => false])
    </div>
</x-app-layout>
