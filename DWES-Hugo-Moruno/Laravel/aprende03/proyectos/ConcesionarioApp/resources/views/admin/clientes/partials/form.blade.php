@props(['cliente' => null, 'submit' => true, 'readonly' => false])

<div class="mx-auto px-8">
    <div class="w-full border p-2 bg-white shadow-lg rounded-lg grid grid-cols-12 gap-2">
        <div class="col-span-12 p-1 bg-gray-300 uppercase tracking-widest font-semibold text-lg text-center">
            {{ $cliente?->nombre ?? 'Registre un cliente' }}
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="nombre" name="nombre" label="Nombre"
                :item="$cliente?->nombre" readonly="{{$readonly}}" required="true"/>
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="email" name="email" label="Email" type="email"
                :item="$cliente?->email" readonly="{{$readonly}}" required="true"/>
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="telefono" name="telefono" label="Teléfono"
                :item="$cliente?->telefono" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="direccion" name="direccion" label="Dirección"
                :item="$cliente?->direccion" readonly="{{$readonly}}"/>
        </div>

        @if($submit)
            <div class="col-span-12 text-right p-1 bg-gray-300">
                <x-buttons.button-form-save>Guardar</x-buttons.button-form-save>
            </div>
        @endif
    </div>
</div>
