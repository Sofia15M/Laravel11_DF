@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fotocamara.css') }}">
@endpush

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center mb-5">
                    {{ __('Crear Nuevo Apartamento') }}
                </h2>

                <form method="POST" action="{{ route('residentes.store') }}" class="w-full flex" enctype="multipart/form-data">
                    @csrf

                    <div class="w-1/2 pr-4">
                        <div class="mb-5">
                            <label for="ID_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificación:</label>
                            <input type="number" name="ID_Residente" id="ID_Residente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
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
                            <input type="text" name="ID_Apartamento" id="ID_Apartamento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                        </div>
                    </div>

                    <div class="w-1/2 pl-4">
                        <div class="mb-5">
                            <label for="Foto_Residente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Residente</label>
                            <input type="file" id="Foto_Residente" name="Foto_Residente" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                        </div>
                        <div class="mb-5">
                            <p>Tomando foto</p>
                            <p>Selecciona un dispositivo</p>
                            <div>
                                <select name="listaDeDispositivos" id="listaDeDispositivos"></select>
                                <button class="text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:azul3 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-Azul3 dark:hover:bg-Azul2 dark:focus:ring-Azul3" id="boton" type="button">Tomar foto</button>
                                <p id="estado"></p>
                            </div>
                            <br>
                            <video muted="muted" id="video" style="max-width: 100%;"></video>
                            <canvas id="canvas" style="display: none;"></canvas>
                        </div>
                        <button type="submit" class="text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:azul3 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-Azul3 dark:hover:bg-Azul2 dark:focus:ring-Azul3">Guardar</button>
                        <a href="{{ route('residentes.index') }}" class="ml-2 text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script src="{{ asset('js/script.js')}}"></script>
@endpush
