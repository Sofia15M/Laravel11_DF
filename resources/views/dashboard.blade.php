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
                        @if (auth()->user()->id_rol == 1)
                            <span class="font-bold text-5xl text-Azul3 leading-tight mt-2">Administrador</span>
                        @else
                            <span class="font-bold text-5xl text-Azul3 leading-tight mt-2">Vigilante</span>
                        @endif
                    </h1>
                    <p class="text-gray-600 mt-4 mb-4">
                        Es obligatorio proteger y usar correctamente la información de todas las
                        personas que ingresan y salen de la unidad residencial, almacenada en
                        nuestra base de datos. Solo el personal autorizado puede acceder a estos
                        datos, que deben ser utilizados únicamente para los fines de seguridad y
                        administración del recinto. Cualquier uso indebido o divulgación no autorizada
                        será sujeto a sanciones.
                    </p>
                    <a href="{{ url('terminos&condiciones') }}" class="bg-Azul3 text-white py-2 px-4 rounded-lg hover:bg-Azul-4 mt-6">
                        Términos y Condiciones
                    </a>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('img/vista1.png') }}" alt="" class="rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <footer class="w-full bg-white py-1 border-t">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex space-x-4 m-3">
                <a href="#" class="text-gray-600 hover:text-gray-800">Bienvenidos</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">Unidad</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">Perfil</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">Crear</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('img/LogoC.png') }}" alt="" class="h-10">
            </div>
            <div class="text-gray-600 space-x-4 m-5">
                © 2024 DigitalFace - Tu futuro en seguridad
            </div>
        </div>
    </footer>
</x-app-layout>
