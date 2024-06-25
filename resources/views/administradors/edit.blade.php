<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Editar Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">

                <form method="POST" action="{{ route('administradors.update', $administrador->ID_Administrador) }}" class="max-w-sm mx-auto">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="Nombre_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo:</label>
                        <input type="text" name="Nombre_Administrador" id="Nombre_Administrador" value="{{ old('Nombre_Administrador', $administrador->Nombre_Administrador) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Edad_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad:</label>
                        <input type="text" name="Edad_Administrador" id="Edad_Administrador" value="{{ old('Edad_Administrador', $administrador->Edad_Administrador) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Cargo_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo:</label>
                        <input type="text" name="Cargo_Administrador" id="Cargo_Administrador" value="{{ old('Cargo_Administrador', $administrador->Cargo_Administrador) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Direccion_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion:</label>
                        <input type="text" name="Direccion_Administrador" id="Direccion_Administrador" value="{{ old('Direccion_Administrador', $administrador->Direccion_Administrador) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Tel_Cel_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                        <input type="text" name="Tel_Cel_Administrador" id="Tel_Cel_Administrador" value="{{ old('Tel_Cel_Administrador', $administrador->Tel_Cel_Administrador) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="Tiempo_trabajo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jornada:</label>
                        <input type="text" name="Tiempo_trabajo" id="Tiempo_trabajo" value="{{ old('Tiempo_trabajo', $administrador->Tiempo_trabajo) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                    <a href="{{ route('administradors.index') }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>