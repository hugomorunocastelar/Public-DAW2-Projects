<style>
    td, th
    {
        padding: 10px 0;
    }
    #modelos:nth-child(even)
    {
        background-color: lightblue;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
                {{ __('Listado de Marcas') }}
                @role('ADMIN')
                <a href="{{ route('admin.marcas.index') }}">
                    <x-buttons.button-edit/>
                </a>
                @endrole
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($marcas->isEmpty())
                    <p>No hay marcas registradas.</p>
                @else
                <table class="table table-bordered w-full p-4">
                    <thead>
                        <tr>
                            <th class="text-left ps-3" >#</th>
                            <th>Nombre</th>
                            <th>País de Origen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($marcas as $marca)
                        <tr class="bg-blue-300 font-extrabold">
                            <td class="ps-3">{{ $marca->id }}</td>
                            <td>{{ $marca->nombre }}</td>
                            <td>{{ $marca->pais_origen }}</td>
                            <td></td>
                        </tr>
                        <tr class="bg-blue-50 font-extrabold">
                            <td colspan="4" class="ps-3">Modelos</td>
                        </tr>
                        @foreach($modelos as $modelo)
                            @if($modelo->marca_id == $marca->id )
                                <tr class="bg-blue-100" id="modelos">
                                    <td class="text-center">{{ $modelo->identificador }}  -  {{ $modelo->año }}</td>
                                    <td>{{ $modelo->nombre }}</td>
                                    <td>{{ $modelo->tipo }}</td>
                                    <td>
                                        <a href="{{route('modelo',$modelo->identificador)}}" class="w-full h-full">
                                            <x-buttons.button-show />
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

</div>
</body>
</html>
