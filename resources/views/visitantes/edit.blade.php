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
                    <a href="{{ route('visitantes.index') }}" title="Volver atrás">
                        <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <line x1="5" y1="12" x2="9" y2="16" />
                            <line x1="5" y1="12" x2="9" y2="8" />
                        </svg>
                    </a>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center mb-5">
                    {{ __('Editar Visitante') }}
                </h2>

                <form method="POST" action="{{ route('visitantes.update', $visitante->ID_Visitante) }}" class="max-w-sm mx-auto">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="Nombre_Visitante" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo:</label>
                        <input type="text" name="Nombre_Visitante" id="Nombre_Visitante" value="{{ old('Nombre_Visitante', $visitante->Nombre_Visitante) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Tel_Cel_Visitante" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                        <input type="text" name="Tel_Cel_Visitante" id="Tel_Cel_Visitante" value="{{ old('Tel_Cel_Visitante', $visitante->Tel_Cel_Visitante) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="ID_Apartamento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                        <input type="text" name="ID_Apartamento" id="ID_Apartamento" value="{{ old('ID_Apartamento', $visitante->ID_Apartamento) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Hora_Salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de salida:</label>
                        <input type="datetime-local" name="Hora_Salida" id="Hora_Salida" value="{{ old('Hora_Salida', $visitante->Hora_Salida) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <button type="submit" class="text-white bg-Azul3 hover:bg-Azul2 focus:ring-4 focus:outline-none focus:azul3 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-Azul3 dark:hover:bg-Azul2 dark:focus:ring-Azul3">Actualizar</button>
                    <a href="{{ route('visitantes.index') }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
