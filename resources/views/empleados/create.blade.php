<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Crear Nuevo Empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">

                        <form method="POST" action="{{ route('empleados.store') }}" class="max-w-sm mx-auto" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-5">
                                <label for="ID_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificación:</label>
                                <input type="text" name="ID_PersonalL" id="ID_PersonalL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Nombre_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo:</label>
                                <input type="text" name="Nombre_PersonalL" id="Nombre_PersonalL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Foto_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Empleado:</label>
                                <input type="file" id="Foto_PersonalL" name="Foto_PersonalL" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Edad_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad:</label>
                                <input type="text" name="Edad_PersonalL" id="Edad_PersonalL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Cargo_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo:</label>
                                <input type="text" name="Cargo_PersonalL" id="Cargo_PersonalL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Direccion_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion:</label>
                                <input type="text" name="Direccion_PersonalL" id="Direccion_PersonalL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Tel_Cel_PersonalL" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                                <input type="text" name="Tel_Cel_PersonalL" id="Tel_Cel_PersonalL" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Tiempo_trabajo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jornada:</label>
                                <input type="text" name="Tiempo_trabajo" id="Tiempo_trabajo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="ID_UNIDAD" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificacion Unidad:</label>
                                <input type="text" name="ID_UNIDAD" id="ID_UNIDAD" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>


                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                            <a href="{{ route('empleados.index') }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                        </form>


            </div>
        </div>
    </div>
</x-app-layout>
