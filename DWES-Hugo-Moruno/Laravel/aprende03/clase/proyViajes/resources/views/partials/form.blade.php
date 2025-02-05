{{-- resources/views/partials/form.blade.php --}}
@csrf
<div class="form-group">
    <label for="nif">NIF</label>
    <input type="text" name="nif" id="nif" class="form-control" value="{{ old('nif', $cliente->nif ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre ?? '') }}" required>
</div>

<div class="form-group">
    <label for="apellido1">Primer Apellido</label>
    <input type="text" name="apellido1" id="apellido1" class="form-control" value="{{ old('apellido1', $cliente->apellido1 ?? '') }}" required>
</div>

<div class="form-group">
    <label for="apellido2">Segundo Apellido</label>
    <input type="text" name="apellido2" id="apellido2" class="form-control" value="{{ old('apellido2', $cliente->apellido2 ?? '') }}">
</div>

<div class="form-group">
    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento ?? '') }}">
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="text" name="foto" id="foto" class="form-control" value="{{ old('foto', $cliente->foto ?? '') }}">
</div>

<div class="form-group">
    <label for="observaciones">Observaciones</label>
    <textarea name="observaciones" id="observaciones" class="form-control">{{ old('observaciones', $cliente->observaciones ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="active">Activo</label>
    <select name="active" id="active" class="form-control">
        <option value="1" {{ (old('active', $cliente->active ?? '') == 1) ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ (old('active', $cliente->active ?? '') == 0) ? 'selected' : '' }}>No</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
