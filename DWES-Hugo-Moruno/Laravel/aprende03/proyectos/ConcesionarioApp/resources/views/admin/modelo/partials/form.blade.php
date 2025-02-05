@props(['modelo' => null, 'submit' => true, 'readonly' => false])

<div class="mx-auto px-8">
    <div class="w-full border p-2 bg-white shadow-lg rounded-lg grid grid-cols-12 gap-2">
        <div class="col-span-12 p-1 bg-gray-300 uppercase tracking-widest font-semibold text-lg text-center">
            {{ $modelo?->nombre ?? 'Registra un Modelo' }}
        </div>

        <!-- Identificador -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="identificador" name="identificador" label="Identificador"
                :item="$modelo?->identificador" readonly="{{$readonly}}" required="true"
            />
        </div>

        <!-- Nombre -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="nombre" name="nombre" label="Nombre"
                :item="$modelo?->nombre" readonly="{{$readonly}}" required="true"
            />
        </div>

        <!-- Tipo -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="tipo" name="tipo" label="Tipo"
                :item="$modelo?->tipo" readonly="{{$readonly}}" required="true"
            />
        </div>

        <!-- Año -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="anho" name="anho" label="Año"
                :item="$modelo?->anho" readonly="{{$readonly}}" required="true" type="date"
            />
        </div>

        <!-- Marca -->
        <div class="col-span-12 md:col-span-6">
            <label for="marca_id" class="block text-sm font-medium text-gray-700">
                Marca
            </label>
            <select
                id="marca_id"
                name="marca_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                {{ $readonly ? 'disabled' : '' }}
                required>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}" {{ $modelo?->marca_id == $marca->id ? 'selected' : '' }}>
                        {{ $marca->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Imagen -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-file-label
                id="imagen" name="imagen" label="Imagen"
                readonly="{{ $readonly }}"
            />
        </div>

        <!-- Mostrar imagen o placeholder -->
        <div class="col-span-12 md:col-span-12 text-center mt-4">
            <img
                title="{{ $modelo?->nombre ?? 'Imagen no disponible' }}"
                class="object-scale-down h-32 w-32 mx-auto rounded-md border"
                src="{{ !empty($modelo?->imagen)
                    ? route('images.show', ['fileType' => 'modelos', 'fileName' => basename($modelo->imagen)])
                    : asset('storage/imagenes/placeholder.png') }}"
                alt="Imagen del modelo">
        </div>

        <!-- Descontinuado -->
        <div class="col-span-12 md:col-span-12">
            <x-inputs.input-checkbox-label
                id="descontinuado" name="descontinuado" label="Descontinuado"
                :item="$modelo?->descontinuado" readonly="{{$readonly}}"
            />
        </div>

        <!-- Botón Guardar -->
        @if($submit)
            <div class="col-span-12 text-right p-1 bg-gray-300">
                <x-buttons.button-form-save>Guardar</x-buttons.button-form-save>
            </div>
        @endif
    </div>
</div>
