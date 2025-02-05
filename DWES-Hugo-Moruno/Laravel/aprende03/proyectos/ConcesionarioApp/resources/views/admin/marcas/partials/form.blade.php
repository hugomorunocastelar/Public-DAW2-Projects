@props(['marca' => null, 'submit' => true, 'readonly' => false])

<div class="mx-auto px-8">
    <div class="w-full border p-4 bg-white shadow-lg rounded-lg grid grid-cols-12 gap-4">
        <!-- Título -->
        <div class="col-span-12 p-2 bg-gray-300 uppercase tracking-widest font-semibold text-lg text-center">
            {{ $marca?->nombre ?? 'Registrar una nueva marca' }}
        </div>

        <!-- Campo: Nombre -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="nombre"
                name="nombre"
                label="Nombre"
                :item="$marca?->nombre"
                readonly="{{ $readonly }}"
                required="true"
            />
        </div>

        <!-- Campo: País de Origen -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="pais_origen"
                name="pais_origen"
                label="País de Origen"
                :item="$marca?->pais_origen"
                readonly="{{ $readonly }}"
                required="true"
            />
        </div>

        <!-- Campo: Imagen -->
        <div class="col-span-12 md:col-span-12">
            <x-inputs.input-file-label
                id="imagen"
                name="imagen"
                label="Imagen"
                readonly="{{ $readonly }}"
            />

            <!-- Mostrar imagen (o placeholder si no hay imagen) -->
            <div class="mt-4 text-center">
                <img
                    title="{{ $marca?->nombre ?? 'Imagen no disponible' }}"
                    class="object-scale-down h-32 w-32 mx-auto rounded-md border"
                    src="{{ !empty($marca?->imagen)
                    ? route('images.show', ['fileType' => 'marcas', 'fileName' => basename($marca->imagen)])
                    : asset('storage/imagenes/placeholder.png') }}"
                    alt="Imagen de la marca">

            </div>
        </div>

        <!-- Botón Guardar -->
        @if ($submit)
            <div class="col-span-12 text-right p-2 bg-gray-300">
                <x-buttons.button-form-save>
                    Guardar
                </x-buttons.button-form-save>
            </div>
        @endif
    </div>
</div>
