<x-app-layout>
    <div class="container">
        <h1>Editar Cliente</h1>
        <form action="{{ route('gastos.update', $gasto->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('gastos.partials.form',
                        ['title' => __('Editar gasto'),
                    'readonly' => false,
                    'submit' => true])
        </form>
    </div>
</x-app-layout>
