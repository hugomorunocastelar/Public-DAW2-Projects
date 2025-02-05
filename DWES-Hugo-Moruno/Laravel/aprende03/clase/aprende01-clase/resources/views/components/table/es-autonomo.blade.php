@props(['autonomo'])         
 @if ($autonomo)
 <p  class="w-fit py-1 px-2 border-b border-gray-200 text-left bg-teal-400 text-xs rounded font-semibold ">Sí</p>
@else
 <p  class="w-fit py-1 px-2 border-b border-gray-200 text-left bg-amber-400 text-xs rounded font-semibold ">No</p>
@endif
