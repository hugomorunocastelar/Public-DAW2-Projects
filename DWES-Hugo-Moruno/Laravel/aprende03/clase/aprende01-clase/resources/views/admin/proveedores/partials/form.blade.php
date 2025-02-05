
<div class="m-4 p-8 rounded shadow border bg-amber-200">
        @csrf
        NIF: <x-input.input-text itemName="nif" :itemValue="$proveedor->nif" placeholder="NIF" :readonly="isset($readonly) && $readonly"/>
        Nombre: <x-input.input-text itemName="nombre" :itemValue="$proveedor->nombre" placeholder="Nmbre" :readonly="isset($readonly) && $readonly"/>
        Razón Social: <x-input.input-text itemName="razon_social" :itemValue="$proveedor->razon_social" placeholder="Razon Social" :readonly="isset($readonly) && $readonly"/>
        Dirección: <x-input.input-text itemName="direccion" :itemValue="$proveedor->direccion" placeholder="direccion" :readonly="isset($readonly) && $readonly"/>
        Telefono: <x-input.input-text itemName="tlf" :itemValue="$proveedor->tlf" placeholder="Telefono" :readonly="isset($readonly) && $readonly"/>
        ¿Autónomo? <input type="checkbox" name="autonomo" value="SI" class="px-2 py-1" value="{{$proveedor-> autonomo ? 'Checked' : ''}}" > <br>
        
</div>
