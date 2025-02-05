<x-app-layout>
    <div class="container">
        <h1>Detalles del Gasto</h1>
        @include('gastos.partials.form',
                    ['title' => __('Ver gasto'),
                    'readonly' => true,
                    'submit' => false])
    </div>
</x-app-layout>
