@props(['id','name','label','routeImage', 'readonly'=>false])
<div class="w-full" x-data="showImage()">
    @isset($label)
        <label for="{{$id}}" class="text-xs block font-bold text-blue-900 mr-2 p-1">{{$label}}</label>
    @endisset
    @if($readonly)
        @if (!empty($item))
            <img src="{{$routeImage}}" class="object-cover max-h-32 mx-auto mt-2 max-w-32 text-center bg-white border p-1 shadow-lg rounded-lg">
        @else
            <img src="{{ asset('images/imagen_no_disponible.png') }}" class="object-cover max-h-32 mx-auto mt-2 max-w-32 text-center bg-white border p-1 shadow-lg rounded-lg">
        @endif
    @else
        {{--Estilo obtenido de https://tw-elements.com/docs/standard/forms/file-input/--}}
        <div class="text-center">
            <input @change="showPreview(event)"
                   id="{{$id}}" @isset($name)  name="{{$name}}" @endisset type="file"
                {{ $attributes->merge(['class' => 'relative m-0 block w-full min-w-0 flex-auto rounded border
                    border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base
                    font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem]
                    file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit
                    file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150
                    file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200
                    focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600
                    dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary']) }}>
            <img id="preview" class="object-cover max-h-32 mx-auto mt-2 max-w-32 text-center bg-white border p-1 shadow-lg rounded-lg"
                 @if (!empty($item))
                     src="{{$routeImage}}"
                @endif
            >
        </div>
    @endif
    @error("$name") <div class="block px-2 italic text-xs text-red-500 font-s text-left">{!!  $message !!}</div> @enderror

    <script>
        function showImage() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
</div>
{{--Previsializacion--}}
{{--https://larainfo.com/blogs/laravel-9-image-upload-with-preview-using-tailwind-css-alpine-js--}}
