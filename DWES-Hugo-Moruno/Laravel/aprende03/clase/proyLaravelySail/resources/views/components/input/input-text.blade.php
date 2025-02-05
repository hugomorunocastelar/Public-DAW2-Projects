@props([ 'itemName', 'placeholder', 'itemValue', 'readonly'])

<input type="text" name="{{ $itemName }}"
       placeholder="{{ $placeholder }}"
       class="w-full px-2 py-1
       @error($itemName)
       border border-red-500
       @enderror
       "
       value="{{ old($itemName, $itemValue) }}"
       @if (isset($readonly) && $readonly) readonly @endif>

@error($itemName)
<div class="bg-red-500 text-xs">
    {!! $message !!}
</div>
@enderror
