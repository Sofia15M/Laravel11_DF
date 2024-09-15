<x-app-layout>

    @if(request()->has('mensaje'))
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                var mensaje = "{!! request('mensaje') !!}"
                if (mensaje){
                    alert(mensaje);
                }
            });
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="mb-4">
                    <a href="{{ route('residentes.index') }}" title="Volver atras">
                        <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="5" y1="12" x2="19" y2="12" />  <line x1="5" y1="12" x2="9" y2="16" />  <line x1="5" y1="12" x2="9" y2="8" /></svg>
                    </a>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center mb-5">
                    {{ __('Crear Nuevo Residente') }}
                </h2>

                <form method="POST" action="{{ route('residentes.store') }}" class="max-w-sm mx-auto" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="ID_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificación:</label>
                        <input type="number" name="ID_Residente" id="ID_Residente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                        <span id="error-id-residente" class="text-red-600 mt-2 text-sm"></span>
                    </div>

                    <div class="mb-5">
                        <label for="Nombre_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo:</label>
                        <input type="text" name="Nombre_Residente" id="Nombre_Residente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div>

                    <div class="mb-5">
                        <label for="Tel_Cel_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                        <input type="text" name="Tel_Cel_Residente" id="Tel_Cel_Residente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div>

                    <div class="mb-5">
                        <label for="ID_Apartamento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Apartamento:</label>
                        <select name="ID_Apartamento" id="id_Apartamento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="">Seleccione un apartamento</option>
                            @foreach($apartamentos as $apartamento)
                                <option value="{{ $apartamento->ID_Apartamento }}">{{ $apartamento->ID_Apartamento }} ({{ $apartamento->status }})</option>
                            @endforeach
                        </select>
                    </div>

{{--                <div class="mb-5">
                        <label for="Foto_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Residente</label>
                        <input type="file" id="Foto_Residente" name="Foto_Residente" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div> --}}

                    <!-- Campo para capturar foto con la cámara -->
                    <div class="mb-5">
                        <label for="Foto_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Residente</label>
                        <div class="mb-4">
                            <video id="video" class="w-full h-64 bg-gray-300"></video>
                            <button id="capture" type="button" class="bg-blue-500 text-white px-4 py-2 mt-4">Capturar Foto</button>
                        </div>
                        <canvas id="canvas" class="hidden w-full max-w-sm rounded-lg border-2 border-gray-300 shadow-md"></canvas>
                        <input type="hidden" id="imageData" name="imageData">
                    </div>

                    <button type="submit" class="text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:azul3 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-Azul3 dark:hover:bg-Azul2 dark:focus:ring-Azul3">Guardar</button>
                    <a href="{{ route('residentes.index') }}" class="ml-2 text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>

                </form>
            </div>
        </div>
    </div>

    <!-- Validación en JavaScript para detectar IDs duplicados -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Array con los IDs de apartamentos existentes
            var residentesIds = @json($residentesIds);

            // Imprimir los IDs en la consola para verificar
            console.log("IDs de residentes existentes:", residentesIds);

            // Validar si el ID de apartamento ya existe
            document.getElementById('ID_Residente').addEventListener('input', function() {
                var idResidente = this.value.trim();

                // Convertir a string para garantizar que la comparación sea correcta
                if (residentesIds.map(String).includes(idResidente)) {
                    document.getElementById('error-id-residente').textContent = 'Este propietario ya existe.';
                } else {
                    document.getElementById('error-id-residente').textContent = '';
                }
            });
        });

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
