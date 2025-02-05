{{-- resources/views/partials/list.blade.php --}}
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>NIF</th>
        <th>Nombre</th>
        <th>Apellido1</th>
        <th>Apellido2</th>
        <th>Activo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nif }}</td>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->apellido1 }}</td>
            <td>{{ $item->apellido2 ?? '-' }}</td>
            <td>{{ $item->active ? 'Sí' : 'No' }}</td>
            <td>
                <a href="{{ route($routePrefix.'.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route($routePrefix.'.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route($routePrefix.'.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
