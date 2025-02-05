<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Modelos más vendidos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($modelos->isEmpty())
                    <p>No hay datos disponibles sobre los modelos más vendidos.</p>
                @else
                    <div class="grid grid-cols-2">
                        @foreach ($modelos as $modelo)
                            <div class="flex justify-center items-center m-4 p-4 border border-4 border-blue-200 rounded-2xl">
                                <div class="card mb-4 w-fit">
                                    @php
                                        $imageUrl = route('images.show', ['fileType' => 'modelos', 'fileName' => $modelo->imagen ?? 'placeholder.png']);
                                    @endphp
                                    <img
                                        src="{{ $imageUrl }}"
                                        class="card-img-top"
                                        alt="Imagen del modelo {{ $modelo->nombre }}"
                                        style="max-height: 200px"
                                    >
                                    <div class="card-body">
                                        <h5 class="card-title font-bold mt-3">{{ strtoupper($modelo->nombre) }}</h5>
                                        <p class="card-text text-center">
                                            Tipo: {{ $modelo->tipo }} <br>
                                            Año: {{ $modelo->anho }} <br>
                                            Vendidos:
                                            {{ $modelosMasVendidos->firstWhere('modelo_coche_id', $modelo->id)->total_vendidos }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
