<div class="form-group">
    <label for="nif">NIF</label>
    <input type="text" name="nif" id="nif" class="form-control" value="{{ old('nif', $empleado->nif ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre ?? '') }}" required>
</div>

<div class="form-group">
    <label for="apellido1">Primer Apellido</label>
    <input type="text" name="apellido1" id="apellido1" class="form-control" value="{{ old('apellido1', $empleado->apellido1 ?? '') }}" required>
</div>

<div class="form-group">
    <label for="apellido2">Segundo Apellido</label>
    <input type="text" name="apellido2" id="apellido2" class="form-control" value="{{ old('apellido2', $empleado->apellido2 ?? '') }}">
</div>

<div class="form-group">
    <label for="active">Activo</label>
    <input type="checkbox" name="active" id="active" {{ old('active', $empleado->active ?? true) ? 'checked' : '' }}>
</div>
