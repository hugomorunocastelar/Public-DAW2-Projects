<x-app-layout>
    <x-slot name="header">
        <div class="text-center" style="font-size: 25px">
            {{ __('Bienvenido a nuestro concesionario!') }}
        </div>
    </x-slot>
    <main class="container mx-auto sm:px-6 lg:px-8">
        <section id="bannerCochesPortadas">
            <div id="divCochesPortadas">
                <div id="textoCochesPortadas">
                    <h2 class="text-xl mb-3 pe-10">Descubre el nuevo Opel Corsa: el equilibrio perfecto entre diseño y rendimiento!</h2>
                    <h4 class="pe-10">Conducir nunca había sido tan emocionante. ¡Pruébalo hoy!</h4>
                </div>
                <img id="imgCochesPortadas" src="{{ asset('/storage/coches/coche1.jpg') }}" alt="">
            </div>
        </section>
        <section id="bannerCochesPortadas">
            <div id="divCochesPortadas">
                <img id="imgCochesPortadas" src="{{ asset('/storage/coches/coche2.jpeg') }}" alt="">
                <div id="textoCochesPortadas">
                    <h2 class="text-xl mb-3 ps-10">El SUV definitivo: estilo, confort y tecnología en un solo vehículo!</h2>
                    <h4 class="ps-16">Disponible en nuestro concesionario de Badajoz. ¡Ven a verlo!</h4>
                </div>
            </div>
        </section>
        <section id="bannerCochesPortadas">
            <div id="divCochesPortadas">
                <div id="textoCochesPortadas">
                    <h2 class="text-xl mb-3 pe-10">Innovación a tu alcance: el nuevo Seat Arona ya está aquí!</h2>
                    <h4 class="pe-10">Ven y experimenta su dinamismo y confort en nuestras instalaciones!</h4>
                </div>
                <img id="imgCochesPortadas" src="{{ url('/storage/coches/coche3.jpg') }}" alt="">
            </div>
        </section>
        <section id="bannerCochesPortadas">
            <div id="divCochesPortadas">
                <img id="imgCochesPortadas" src="{{ url('/storage/coches/coche4.png') }}" alt="">
                <div id="textoCochesPortadas">
                    <h2 class="text-xl mb-3 ps-10">Compacto, elegante y potente: el Opel Astra redefine la conducción urbana!</h2>
                    <h4 class="ps-10">Consulta nuestras promociones especiales por tiempo limitado!</h4>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
