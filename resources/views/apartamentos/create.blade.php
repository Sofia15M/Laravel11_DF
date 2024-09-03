<x-app-layout>


    @if(request()->has('mensaje'))`
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                var mensaje = "{request('mensaje')}"
                if (mensaje){
                    alert("sjafhasj")
                }
            });
        </script>
    @endif
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8 ">
                <div class="mb-4">
                    <a href="{{ route('apartamentos.index') }}" title="Volver atras">
                        <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="5" y1="12" x2="19" y2="12" />  <line x1="5" y1="12" x2="9" y2="16" />  <line x1="5" y1="12" x2="9" y2="8" /></svg>
                    </a>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center mb-5">
                    {{ __('Crear Nuevo Apartamento') }}
                </h2>
                <form method="POST" action="{{ route('apartamentos.store') }}" class="max-w-sm mx-auto">
                    @csrf

                    <div class="mb-5">
                        <label for="ID_Apartamento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Apartamento:</label>
                        <input type="text" name="ID_Apartamento" id="ID_Apartamento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div>

                    <div class="mb-5">
                        <label for="Descripcion_Apartamento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion:</label>
                        <input type="text" name="Descripcion_Apartamento" id="Descripcion_Apartamento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div>

                    <div class="mb-5">
                        <label for="ID_Propietario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificacion Propietario:</label>
                        <input type="text" name="ID_Propietario" id="ID_Propietario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div>

                    <div class="mb-5">
                        <label for="ID_UNIDAD" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificacion Unidad:</label>
                        <input type="number" name="ID_UNIDAD" id="ID_UNIDAD" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-Azul3 focus:border-Azul3 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-Azul3 dark:focus:border-Azul3" required>
                    </div>

                    <button type="submit" class="text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:azul3 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-Azul3 dark:hover:bg-Azul2 dark:focus:ring-Azul3">Guardar</button>
                    <a href="{{ route('apartamentos.index') }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
