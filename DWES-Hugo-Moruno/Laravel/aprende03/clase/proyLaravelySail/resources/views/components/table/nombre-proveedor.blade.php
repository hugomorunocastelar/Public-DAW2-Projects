@props(['proveedor'])         

@if ($proveedor->autonomo)
{{ $proveedor->apellido1 }} {{ $proveedor->apellido2 }}
@else
{{ $proveedor->razon_social }}
@endif
