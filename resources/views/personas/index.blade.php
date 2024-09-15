<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Listado De Pepersonas Reconocidas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <form action="{{ route('personas.index') }}" method="GET">
                            <div class="flex items-center mb-5">
                                <input type="text" name="search" placeholder="Buscar por ID o Nombre" class="border border-gray-200 bg-gray-20 text-gray-900 rounded-md px-4 py-2 w-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-Azul3">
                                <button type="submit" class="ml-2 bg-Azul3 text-white font-bold py-2 px-4 rounded hover:bg-Azul2">Buscar</button>
                            </div>
                        </form>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Identificacion</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Foto</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personas as $persona)
                                <tr>
                                    <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $persona->ID }}</td>
                                    <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                        <img src="{{ asset('storage/' . $persona->Foto) }}" alt="Foto" class="h-30 w-20 mx-auto">
                                    </td>
                                    <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $persona->Tabla }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
