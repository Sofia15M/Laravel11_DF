<x-app-layout>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8 flex custom-shape">
                <div class="w-1/2 pr-8">
                    <h3 class="font-semibold text-3xl text-gray-800 leading-tight">
                        Bienvenido a
                    </h3>
                    <h1 class="font-bold text-5xl text-Azul3 leading-tight mt-2">
                        DigitalFace
                    </h1>
                    <p class="text-gray-600 mt-4">
                        Es obligatorio proteger y usar correctamente la información de todas las
                        personas que ingresan y salen de la unidad residencial, almacenada en
                        nuestra base de datos. Solo el personal autorizado puede acceder a estos
                        datos, que deben ser utilizados únicamente para los fines de seguridad y
                        administración del recinto. Cualquier uso indebido o divulgación no autorizada
                        será sujeto a sanciones.
                    </p>
                    <button class="mt-6 bg-Azul3 text-white py-2 px-4 rounded-lg hover:bg-Azul-4">
                        Terminos y Condiciones
                    </button>
                </div>
                <div class="w-1/2">
                    <img src="https://via.placeholder.com/400" alt="" class="rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <footer class="w-full bg-white py-4 border-t">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-800">PRODUCTS</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">BLOG</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">SHOP</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">CONTACTS</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('img/LogoC.png') }}" alt="Icon" class="h-6">
            </div>
            <div class="text-gray-600">
                © 2015 Dreamy Inc. All rights reserved
            </div>
        </div>
    </footer>
</x-app-layout>
