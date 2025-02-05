<div class="form-group">
    <label for="referencia">Referencia</label>
    <input type="text" name="referencia" id="referencia" class="form-control" value="{{ old('referencia', $viaje->referencia ?? '') }}" required>
</div>

<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $viaje->titulo ?? '') }}" required>
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $viaje->slug ?? '') }}" required>
</div>

<div class="form-group">
    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio" class="form-control" value="{{ old('precio', $viaje->precio ?? '') }}" step="0.01">
</div>

<div class="form-group">
    <label for="active">Activo</label>
    <input type="checkbox" name="active" id="active" {{ old('active', $viaje->active ?? true) ? 'checked' : '' }}>
</div>
