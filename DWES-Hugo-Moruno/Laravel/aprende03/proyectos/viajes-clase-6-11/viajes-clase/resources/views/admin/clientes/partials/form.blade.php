@props(['cliente','submit'=>true,'readonly'=>false])

<div class="mx-auto px-8">

    <div class="w-full border p-2 bg-white shadow-lg rounded-lg grid grid-cols-12 gap-2">
        <div class="col-span-12 p-1 bg-gray-300 uppercase tracking-widest font-semibold text-lg text-center">
            {{ $title }}
        </div>
        <!-- Primera fila: Nif -->
        <div class="col-span-12 md:col-span-3">
            <x-inputs.input-text-label id="nif" name="nif" label="Nif"
                                       :item="$cliente->nif" readonly="{{$readonly}}"/>
        </div>
        <div class="col-span-none md:col-span-9"></div>

        <!-- Segunda fila: Nombre, Apellido1, Apellido2 -->
        <div class="col-4 ">
            <x-inputs.input-text-label id="nombre" name="nombre" label="Nombre"
                                       :item="$cliente->nombre" readonly="{{$readonly}}"/>
        </div>
        <div class="col-4 md:col-span-4">
            <x-inputs.input-text-label id="apellido1" name="apellido1" label="Apellido 1º"
                                       :item="$cliente->apellido1" readonly="{{$readonly}}"/>
        </div>
        <div class="col-4 md:col-span-4">
            <x-inputs.input-text-label id="apellido2" name="apellido2" label="Apellido 2º"
                                       :item="$cliente->apellido2" readonly="{{$readonly}}"/>
        </div>

        <!-- Tercera fila: fecha nacimiento, foto -->
        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label id="fechaNacimiento" name="fecha_nacimiento" label="Fecha nac."
                                       :item="$cliente->fecha_nacimiento" type="date" readonly="{{$readonly}}"/>
        </div>
        <div class="col-span-12 md:col-span-2"></div>
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-image-label id="foto" name="foto" label="Foto"
                                        :item="$cliente->foto" readonly="{{$readonly}}"/>
        </div>

        <!-- Cuarta fila: observaciones -->
        <div class="col-span-12 md:col-span-12">
            <x-inputs.textarea-label id=" observaciones
        " name="observaciones" label="Observaciones"
        :item="$cliente->observaciones" readonly="{{$readonly}}"/>


        @if($submit)
            <div class="col-span-12 text-right p-1 bg-gray-300">
                <x-buttons.button-form-save>Guardar</x-buttons.button-form-save>
            </div>
        @endif
    </div>


</div>
