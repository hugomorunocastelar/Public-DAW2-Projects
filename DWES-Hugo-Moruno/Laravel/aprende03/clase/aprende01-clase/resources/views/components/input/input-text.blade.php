@props([ 'itemName', 'placeholder', 'itemValue', 'readonly'])

<input type="text" name="{{ $itemName }}" placeholder="{{ $placeholder }}" class="w-full px-2 py-1"
    value="{{ $itemValue }}" @if (isset($readonly) && $readonly) readonly @endif>
