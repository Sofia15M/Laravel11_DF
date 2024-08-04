@push('styles')
    <link rel="stylesheet" href="{{ asset('css/fotocamara.css') }}">
@endpush

<x-app-layout>
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
                            <div class="mb-5 text-center">
                                <p class="text-lg font-semibold">Tomar foto</p>
                                <p class="text-gray-600">Selecciona un dispositivo</p>
                                <div class="flex flex-col items-center gap-4 mt-4">
                                    <select name="listaDeDispositivos" id="listaDeDispositivos" class="p-2 border border-gray-300 rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3 w-full">
                                        <!-- Opciones se agregan dinámicamente -->
                                    </select>
                                    <button class="flex items-center justify-center text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:ring-Azul3 font-medium rounded-lg text-sm px-3 py-2.5" id="boton" type="button">
                                        <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"/>
                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"/>
                                            <path d="M4 16v2a2 2 0 0 0 2 2h2"/>
                                            <path d="M16 4h2a2 2 0 0 1 2 2v2"/>
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"/>
                                            <line x1="9" y1="10" x2="9.01" y2="10"/>
                                            <line x1="15" y1="10" x2="15.01" y2="10"/>
                                            <path d="M9.5 15a3.5 3.5 0 0 0 5 0"/>
                                        </svg>
                                    </button>
                                </div>
                                <p id="estado" class="mt-2 text-gray-500"></p>
                            </div>
                            <video muted="muted" id="video" class="w-full rounded-lg shadow-sm"></video>
                            <canvas id="canvas" class="hidden"></canvas>
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
