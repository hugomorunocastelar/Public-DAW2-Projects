<div class="mx-10 p-10 bg-gray-200 shadow-amber-100">
    <table>
        <thead>
        <tr class="bg-amber-200 text-black">
            <th class="py-2 px-4 text-left">NIF</th>
            <th class="py-2 px-4 text-left">Nombre</th>
            <th class="py-2 px-4 text-left">Apellidos</th>
            <th class="py-2 px-4 text-left">Fecha Nacimiento</th>
            <th class="py-2 px-4 text-left">Observaciones</th>
            <th class="py-2 px-4 text-left">Foto</th>
            <th class="py-2 px-4 text-left">Activo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <td>{{$empleado -> nif}}</td>
                <td>{{$empleado -> nombre}}</td>
                <td>{{$empleado -> apellido1}} {{$empleado -> apellido2}}</td>
                <td>{{$empleado -> fecha_nacimiento}}</td>
                <td>
                    {{--$cliente -> observaciones--}} Observacion
                </td>
                <td>
                    {{--$cliente -> foto--}} Foto
                </td>
                <td>
                    @if($empleado -> active)
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
    {{$empleados->links()}}
</div>
