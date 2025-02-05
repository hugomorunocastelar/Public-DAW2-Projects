@props(['name', 'label', 'item' => null, 'readonly' => false])

<div class="w-full">
    @isset($label)
        <label class="text-xs block font-bold text-blue-900 mr-2 p-1">{{$label}}</label>
    @endisset
    <input
        type="file"
        @isset($name) name="{{$name}}" @endisset
        @if($readonly) disabled @endif
        {{ $attributes->merge(['class' => 'w-full px-2 py-1 border border-emerald-300 rounded']) }}
    >
    @if($item)
        <div class="mt-2">
            <a href="{{$item}}" target="_blank" class="text-emerald-500 text-xs underline">
                Ver archivo actual
            </a>
        </div>
    @endif
    @error("$name")
    <div class="block px-2 italic text-xs text-red-500 font-s text-left">
        {!! $message !!}
    </div>
    @enderror
</div>
