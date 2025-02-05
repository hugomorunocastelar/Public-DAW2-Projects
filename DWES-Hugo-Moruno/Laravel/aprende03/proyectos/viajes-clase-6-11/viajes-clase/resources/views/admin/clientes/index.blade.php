<x-guest-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('Administración de clientes') }} {{--Busca dentro del .json si hay algo en la traduccion.--}}
                        {{--h2 o h1 lo usamos porque los buscadodres suelen remitir a ese formato como títulos de pagina.--}}
        <a href="{{route('admin.clientes.create')}}"
            class="px-2 py-1 bg-cyan-500">
            <i class="fa-solid fa-plus fa-lg"></i>
        </a>
    </h2>
</x-slot>
    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-4">

                @include('admin.clientes.partials.list')

            </div>
        </div>
    </div>
</x-guest-layout>
