<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administración') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" x-data="{
                tab: sessionStorage.getItem('lastTab') || 'clientes',
                setTab(tabName) {
                    this.tab = tabName;
                    sessionStorage.setItem('lastTab', tabName);
                }
            }">
                <div class="flex space-x-4 border-b pb-2">
                    <button
                        @click="setTab('clientes')"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': tab === 'clientes' }"
                        class="px-4 py-2 text-gray-700 hover:text-blue-500 focus:outline-none"
                    >
                        Clientes
                    </button>
                    <button
                        @click="setTab('coches')"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': tab === 'coches' }"
                        class="px-4 py-2 text-gray-700 hover:text-blue-500 focus:outline-none"
                    >
                        Coches
                    </button>
                    <button
                        @click="setTab('modelos')"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': tab === 'modelos' }"
                        class="px-4 py-2 text-gray-700 hover:text-blue-500 focus:outline-none"
                    >
                        Modelos
                    </button>
                    <button
                        @click="setTab('marcas')"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': tab === 'marcas' }"
                        class="px-4 py-2 text-gray-700 hover:text-blue-500 focus:outline-none"
                    >
                        Marcas
                    </button>
                    <button
                        @click="setTab('usuarios')"
                        :class="{ 'border-b-2 border-blue-500 text-blue-500': tab === 'usuarios' }"
                        class="px-4 py-2 text-gray-700 hover:text-blue-500 focus:outline-none"
                    >
                        Usuarios
                    </button>
                </div>

                <div class="mt-4">
                    <div x-show="tab === 'clientes'" class="p-4">
                        @include('admin.clientes.partials.list')
                    </div>

                    <div x-show="tab === 'coches'" class="p-4">
                        @include('admin.coches.partials.list')
                    </div>

                    <div x-show="tab === 'modelos'" class="p-4">
                        @include('admin.modelo.partials.list')
                    </div>

                    <div x-show="tab === 'marcas'" class="p-4">
                        @include('admin.marcas.partials.list')
                    </div>

                    <div x-show="tab === 'usuarios'" class="p-4">
                        @include('admin.usuarios.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
