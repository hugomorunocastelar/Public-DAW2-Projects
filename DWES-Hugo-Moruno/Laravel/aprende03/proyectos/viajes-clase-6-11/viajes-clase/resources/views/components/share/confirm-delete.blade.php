@props(['open' => false, 'url'])

<div class="inline-block" x-data="{ open: {{ $open ? 'true' : 'false' }} }">

    <x-buttons.button-table action="delete" @click="open = true"/>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        {{-- Fondo oscuro --}}
        <div class="fixed inset-0 bg-black opacity-50"></div>

        {{-- Contenido del modal --}}
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <form action="{{$url}}" method="post">
                @csrf
                @method('DELETE')

                <div
                    class="relative bg-white rounded-lg w-full max-w-md p-6"
                    @click.away="open = false"
                >
                    {{-- Botón cerrar --}}
                    <button
                        @click="open = false"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Cerrar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- Título del modal --}}
                    <div class="text-xl font-semibold mb-4">
                        Confirmación del borrado
                    </div>

                    {{-- Contenido del modal --}}
                    <div class="mt-2">

                        {!! $slot !!}

                    </div>

                    {{-- Pie del modal --}}
                    <div class="mt-4 flex justify-end space-x-3">

                        <button type="button"
                                @click="open = false"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >
                            Cerrar
                        </button>

                        <button type="submit"
                                @click="open = false"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >
                            Borrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
