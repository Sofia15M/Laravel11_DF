<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista De Domiciliarios Desativados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('domiciliarios.index') }}" title="Volver atras">
                            <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="5" y1="12" x2="19" y2="12" />  <line x1="5" y1="12" x2="9" y2="16" />  <line x1="5" y1="12" x2="9" y2="8" /></svg>
                        </a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. domiciliario</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Foto</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Nombre Completo</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Nombre Residente</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Apartamento</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($domiciliarios as $domiciliario)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $domiciliario->Id_Domiciliario }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                    <img src="{{ asset('storage/' . $domiciliario->Foto_Domiciliario) }}" alt="Foto Domiciliario" class="h-30 w-20 mx-auto">
                                </td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $domiciliario->Nombre_Domiciliario }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $domiciliario->Nombre_Recidente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $domiciliario->id_Apartamento }}</td>

                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('domiciliarios.edit', $domiciliario->Id_Domiciliario) }}" class="bg-verde dark:bg-verde1 hover:bg-verde dark:hover:bg-verde1 text-white font-bold py-2 px-4 rounded mr-2">Activar</a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
