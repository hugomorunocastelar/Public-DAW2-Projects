<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="py-10 text-center text-2xl">Loggeado correctamente!</h1>
            </div>
        </div>
    </div>
</x-app-layout>
