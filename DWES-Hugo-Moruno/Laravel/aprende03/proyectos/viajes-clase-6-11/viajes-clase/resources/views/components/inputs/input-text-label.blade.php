@props(['name','label','item', 'readonly'=>false])
<div class="w-full">
    @isset($label)
        <label class="text-xs block font-bold text-blue-900 mr-2 p-1">{{$label}}</label>
    @endisset
    <input  type="text"
            @isset($name)  name="{{$name}}" @endisset
            @if($readonly) readonly @endif
            value="{{old($name,$item)}}"
        {{ $attributes->merge(['class' => 'w-full px-2 py-1 border border-emerald-300 rounded']) }}>
    @error("$name") <div class="block px-2 italic text-xs text-red-500 font-s text-left">{!!  $message !!}</div> @enderror
</div>
