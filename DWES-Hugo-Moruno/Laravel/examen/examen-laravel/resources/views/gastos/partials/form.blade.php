@props(['gasto' => null, 'submit' => true, 'readonly' => false])

<div class="mx-auto px-8">
    <div class="w-full border p-2 bg-white shadow-lg rounded-lg grid grid-cols-12 gap-2">
        <div class="col-span-12 p-1 bg-gray-300 uppercase tracking-widest font-semibold text-lg text-center">
            {{ $gasto?->id ?? 'Registre un gasto' }}
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="gasto" name="gasto" label="Gasto" type="number"
                :item="$gasto?->gasto" readonly="{{$readonly}}" required="true"/>
        </div>

        <div class="col-span-12 md:col-span-6">
            <label for="conceptos_id" class="block text-sm font-medium text-gray-700">
                Concepto
            </label>
            <select
                id="conceptos_id"
                name="conceptos_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                {{ $readonly ? 'disabled' : '' }}
                required>
                @foreach ($conceptos as $concepto)
                    <option value="{{ $concepto->id }}" {{ $gasto?->conceptos_id == $concepto->id ? 'selected' : '' }}>
                        {{ $concepto->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-file-label
                id="imagen" name="imagen" label="Imagen"
                readonly="{{ $readonly }}"
            />
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="fecha" name="fecha" label="Fecha" type="date"
                                       :item="$gasto?->fecha" readonly="{{$readonly}}" required="true"/>
        </div>

        @if($submit)
            <div class="col-span-12 text-right p-1 bg-gray-300">
                <x-buttons.button-form-save>Guardar</x-buttons.button-form-save>
            </div>
        @endif
    </div>
</div>
