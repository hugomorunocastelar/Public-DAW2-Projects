<x-app-layout>
    <div class="container">
        <h1>Editar Cliente</h1>
        <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.clientes.partials.form',
                        ['title' => __('Editar Cliente'),
                    'readonly' => false,
                    'submit' => true])
        </form>
    </div>
</x-app-layout>
