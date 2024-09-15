<x-app-layout>

    @if(request()->has('mensaje'))
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                var mensaje = "{{ request('mensaje') }}"; // Esto imprime el valor real del mensaje
                if (mensaje){
                    alert(mensaje); // Esto muestra el mensaje real en la alerta
                }
            });
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">

                <div class="mb-4">
                    <a href="{{ route('empleados.index') }}" title="Volver atrás">
                        <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <line x1="5" y1="12" x2="9" y2="16" />
                            <line x1="5" y1="12" x2="9" y2="8" />
                        </svg>
                    </a>
                </div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center mb-5">
                    {{ __('Crear Editar Empleado') }}
                </h2>

                <form method="POST" action="{{ route('empleados.update', $empleado->ID_PersonalL) }}" class="max-w-sm mx-auto">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="Nombre_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo:</label>
                        <input type="text" name="Nombre_PersonalL" id="Nombre_PersonalL" value="{{ old('Nombre_PersonalL', $empleado->Nombre_PersonalL) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Edad_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad:</label>
                        <input type="text" name="Edad_PersonalL" id="Edad_PersonalL" value="{{ old('Edad_PersonalL', $empleado->Edad_PersonalL) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Cargo_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo:</label>
                        <input type="text" name="Cargo_PersonalL" id="Cargo_PersonalL" value="{{ old('Cargo_PersonalL', $empleado->Cargo_PersonalL) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Direccion_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion:</label>
                        <input type="text" name="Direccion_PersonalL" id="Direccion_PersonalL" value="{{ old('Direccion_PersonalL', $empleado->Direccion_PersonalL) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Tel_Cel_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                        <input type="text" name="Tel_Cel_PersonalL" id="Tel_Cel_PersonalL" value="{{ old('Tel_Cel_PersonalL', $empleado->Tel_Cel_PersonalL) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Tiempo_trabajo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jornada:</label>
                        <input type="text" name="Tiempo_trabajo" id="Tiempo_trabajo" value="{{ old('Tiempo_trabajo', $empleado->Tiempo_trabajo) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <!-- Mostrar la foto actual -->
                    <div class="mb-5">
                        <label for="Foto_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Actual</label>
                        <img src="{{ asset('storage/' . $empleado->Foto_PersonalL) }}" alt="Foto del PersonalL" class="w-50">
                    </div>

                    <!-- Área para capturar nueva imagen con la cámara -->
                    <div class="mb-5">
                        <label for="Foto_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva Foto (opcional)</label>
                        <div class="mb-4">
                            <video id="video" class="w-full h-64 bg-gray-300"></video>
                            <button id="capture" type="button" class="bg-blue-500 text-white px-4 py-2 mt-4">Capturar Foto</button>
                        </div>
                        <canvas id="canvas" class="hidden w-full max-w-sm rounded-lg border-2 border-gray-300 shadow-md"></canvas>
                        <input type="hidden" id="imageData" name="imageData">
                    </div>

                    <button type="submit" class="text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:azul3 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-Azul3 dark:hover:bg-Azul2 dark:focus:ring-Azul3">Actualizar</button>
                    <a href="{{ route('empleados.index') }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                </form>

            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('capture');
            const imageDataInput = document.getElementById('imageData');
            const context = canvas.getContext('2d');

            // Acceder a la cámara
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(err => {
                    console.error('Error al acceder a la cámara:', err);
                });

            // Capturar la imagen
            captureButton.addEventListener('click', function () {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = canvas.toDataURL('image/png');
                imageDataInput.value = imageData;
                canvas.classList.remove('hidden');
            });
        });

    </script>
</x-app-layout>
