@props(['coche' => null, 'clientes' => [], 'modelos' => [], 'submit' => true, 'readonly' => false])

<div class="mx-auto px-8">
    <div class="w-full border p-2 bg-white shadow-lg rounded-lg grid grid-cols-12 gap-2" x-data="{ vendido: {{ $coche?->vendido ? 'true' : 'false' }} }">
        <div class="col-span-12 p-1 bg-gray-300 uppercase tracking-widest font-semibold text-lg text-center">
            {{ $coche?->matricula ?? 'Registra un Coche' }}
        </div>

        <!-- Matrícula -->
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="matricula" name="matricula" label="Matrícula"
                :item="$coche?->matricula" readonly="{{ $readonly }}" required="true"
            />
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label
                id="color" name="color" label="Color"
                :item="$coche?->color" readonly="{{ $readonly }}" required="true"
            />
        </div>

        <div class="col-span-12 md:col-span-6">
            <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente</label>
            <select id="cliente_id" name="cliente_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    {{ $readonly ? 'disabled' : '' }}
                    @change="vendido = $event.target.value !== ''">
                <option value="">-----</option>
                @foreach ($clientes as $cliente)
                    <option
                        value="{{ $cliente->id }}"
                        {{ $coche?->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-12 md:col-span-6">
            <label for="modelo_coche_id" class="block text-sm font-medium text-gray-700">Modelo</label>
            <select id="modelo_coche_id" name="modelo_coche_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    {{ $readonly ? 'disabled' : '' }} required>
                <option value="">-- Seleccione un Modelo --</option>
                @foreach ($modelos as $modelo)
                    <option
                        value="{{ $modelo->id }}"
                        {{ $coche?->modelo_coche_id == $modelo->id ? 'selected' : '' }}>
                        {{ $modelo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-12 md:col-span-12">
            <label for="vendido" class="block text-sm font-medium text-gray-700">Vendido</label>
            <input type="checkbox" id="vendido" name="vendido"
                   class="rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                   x-bind:checked="vendido" readonly="{{ $readonly }}" />
        </div>

        @if ($submit)
            <div class="col-span-12 text-right p-1 bg-gray-300">
                <x-buttons.button-form-save>Guardar</x-buttons.button-form-save>
            </div>
        @endif
    </div>
</div>
