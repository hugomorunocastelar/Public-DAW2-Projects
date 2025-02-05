@props(['action'=>'','PEPITO'])

@switch($action)
    @case('show')
        <button type="button"
            {{ $attributes->merge(['class' => 'bg-cyan-400 hover:bg-cyan-100 w-6 rounded']) }}>
            <i class="fa-solid fa-eye"></i>
        </button>
        @break
    @case('update')
        <button type="button"
            {{ $attributes->merge(['class' => 'bg-indigo-600 hover:bg-indigo-400 text-white w-6 rounded']) }}>
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
        @break
    @case('delete')
        <button type="button"
            {{ $attributes->merge(['class' => 'bg-red-600 hover:bg-red-400 text-white w-6 rounded']) }}>
            <i class="fa-solid fa-trash"></i>
        </button>
        @break
@endswitch
