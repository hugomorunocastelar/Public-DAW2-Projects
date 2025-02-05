<div class="mx-10 p-10 bg-gray-200 shadow-amber-100">
    <table>
        <thead>
        <tr class="bg-amber-200 text-black">
            <th class="py-2 px-4 text-left">Referencia</th>
            <th class="py-2 px-4 text-left">Título</th>
            <th class="py-2 px-4 text-left">Slug</th>
            <th class="py-2 px-4 text-left">Precio</th>
            <th class="py-2 px-4 text-left">Participantes</th>
            <th class="py-2 px-4 text-left">Salida</th>
            <th class="py-2 px-4 text-left">Llegada</th>
            <th class="py-2 px-4 text-left">Descripción</th>
            <th class="py-2 px-4 text-left">Foto</th>
            <th class="py-2 px-4 text-left">Activo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($viajes as $viaje)
            <tr>
                <td>{{$viaje -> referencia}}</td>
                <td>{{$viaje -> titulo}}</td>
                <td>{{$viaje -> slug}}</td>
                <td>{{$viaje -> precio}}</td>
                <td>{{$viaje -> participantes}}</td>
                <td>{{$viaje -> salida}}</td>
                <td>{{$viaje -> llegada}}</td>
                <td>
                    {{--$cliente -> descripcion--}} Descripción
                </td>
                <td>
                    {{--$cliente -> foto--}} Foto
                </td>
                <td>
                    @if($viaje -> activo)
                        Sí
                    @else
                        No
                    @endif
                </td>
                <td>
                    <x-button.btn-show/>
                    <x-button.btn-edit/>
                    <x-button.btn-delete/>
                    <x-button.btn-expand/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$viajes->links()}}
</div>
