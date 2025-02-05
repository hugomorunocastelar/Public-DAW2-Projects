<div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-lime-200">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md table-striped">
        <thead>
        <tr class="bg-amber-200 text-black">
            <th class="py-2 px-4 text-left">NIF</th>
            <th class="py-2 px-4 text-left">Tipo</th>
            <th class="py-2 px-4 text-left">Nombre</th>
            <th class="py-2 px-4 text-left">Apellidos / Razón Social</th>
            <th class="py-2 px-4 text-left">Autónomo</th>
            <th class="py-2 px-4 text-left">Teléfono</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($proveedores as $proveedor)
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $proveedor->nif }}</td>
                <td class="py-2 px-4 border-b border-gray-200 text-left">
                    @if ($proveedor->autonomo)
                        Persona Física
                    @else
                        Persona Jurídica
                    @endif
                </td>
                <td class="py-2 px-4 border-b border-gray-200 text-left">
                    @if ($proveedor->autonomo)
                        {{ $proveedor->nombre }}
                    @else
                        -
                    @endif
                </td>
                <td class="py-2 px-4 border-b border-gray-200 text-left">
                    <x-table.nombre-proveedor :proveedor="$proveedor" />
                </td>
                <td>
                    <x-table.es-autonomo :autonomo="$proveedor->autonomo" />
                </td>
                <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $proveedor->tlf }}</td>
                <td><a href="{{route('admin.proveedores.show', $proveedor->id)}}"><x-button.show-table-button /></a> </td>
                <td><a href="{{route('admin.proveedores.edit', $proveedor->id)}}"><x-button.edit-table-button /></a></td>
                <td>        <form action="{{route('admin.proveedores.destroy',$proveedor -> id)}}">
                        @method('DELETE')
                        @csrf
                        <x-button.delete-table-button />
                    </form> </td>
                <td><a href="{{route('admin.proveedores.create', $proveedor->id)}}"><x-button.new-table-button/></a ></td>
            </tr>
            <tr>
                <td colspan="6">
                    <div>
                        <p> <span class="font-semibold">Dirección:</span> {{ $proveedor->direccion }}</p>
                        <p> <span class="font-semibold">Observaciones:</span> {{ $proveedor->observaciones }}
                        </p>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$proveedores->links()}}
</div>
