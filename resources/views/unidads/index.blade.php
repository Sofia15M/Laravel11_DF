<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Informacion Unidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <!-- Contenedor principal con flex para dividir el espacio -->
                <div class="flex flex-wrap lg:flex-nowrap">
                    <!-- Sección de los párrafos -->
                    <div class="w-full lg:w-1/2 pr-8">
                        @foreach($unidads as $unidad)
                            <p><strong>N. identificador de la unidad: </strong> {{ $unidad->ID_UNIDAD }}</p>
                            <p><strong>Nombre de la unidad: </strong> {{ $unidad->Nombre_Unidad }}</p>
                            <p><strong>Telefono: </strong> {{ $unidad->Tel_Unidad }}</p>
                            <p><strong>Direccion: </strong> {{ $unidad->Direccion_Unidad }}</p>
                            <p><strong>Cantidad de apartamentos: </strong> {{ $unidad->Cantida_Apartamentos_Unidad }}</p>
                        @endforeach
                        @if (auth()->user()->id_rol == 1)
                            <div class="mb-4">
                                <a href="{{ route('unidads.edit', $unidad->ID_UNIDAD) }}" class="bg-verde dark:bg-verde1 hover:bg-verde dark:hover:bg-verde1 text-white font-bold py-2 px-4 rounded mr-2 mb-2 float-left" title="Editar">
                                    <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Sección de la imagen -->
                    <div class="w-full lg:w-1/2">
                        @foreach ($unidads as $unidad)
                            <img src="{{ $unidad->Foto_Unidad }}" alt="Foto de la unidad" class="object-cover rounded-lg shadow-lg" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


