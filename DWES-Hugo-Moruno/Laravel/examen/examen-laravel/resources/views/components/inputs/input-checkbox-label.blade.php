@props(['name', 'label', 'item' => false, 'readonly' => false])

<div class="w-full">
    @isset($label)
        <label class="text-xs block font-bold text-blue-900 mr-2 p-1 flex items-center">
            <input
                type="checkbox"
                @isset($name) name="{{$name}}" @endisset
                @if($readonly) disabled @endif
                @if(old($name, $item)) checked @endif
                {{ $attributes->merge(['class' => 'mr-2 border border-emerald-300 rounded focus:ring-emerald-500']) }}
            >
            {{$label}}
        </label>
    @endisset
    @error("$name")
    <div class="block px-2 italic text-xs text-red-500 font-s text-left">
        {!! $message !!}
    </div>
    @enderror
</div>
