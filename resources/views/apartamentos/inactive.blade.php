<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista De Apartamentos Desactivados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('apartamentos.index') }}" title="Volver atras">
                            <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="5" y1="12" x2="19" y2="12" />  <line x1="5" y1="12" x2="9" y2="16" />  <line x1="5" y1="12" x2="9" y2="8" /></svg>
                        </a>
                    </div>

                    <div class="mb-4">
                        <form action="{{ route('apartamentos.inactive') }}" method="GET">
                            <div class="flex items-center mb-5">
                                <input type="text" name="search" placeholder="Buscar por ID o Nombre" class="border border-gray-200 bg-gray-20 text-gray-900 rounded-md px-4 py-2 w-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-Azul3">
                                <button type="submit" class="ml-2 bg-Azul3 text-white font-bold py-2 px-4 rounded hover:bg-Azul2">Buscar</button>
                            </div>
                        </form>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">#</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Apartamento</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Descripción</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Propietario</th>
                                @if (auth()->user()->id_rol == 1)
                                    <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apartamentos as $index => $apartamento)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $index + 1}}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $apartamento->ID_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $apartamento->Descripcion_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $apartamento->ID_Propietario }}</td>
                                @if (auth()->user()->id_rol == 1)
                                    <td class="border px-4 py-2 text-center">
                                        <div class="flex justify-center">
                                            <button type="button" onclick="confirmActivo('{{ $apartamento->ID_Apartamento }}')" class="bg-verde dark:bg-verde1 hover:bg-verde1 dark:hover:bg-verde text-white font-bold py-2 px-4 rounded mr-2" title="Activar">
                                                <svg class="h-5 w-5 text-gray-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Componente de paginación -->
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a href="{{ $apartamentos->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            <a href="{{ $apartamentos->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando
                                    <span class="font-medium">{{ $apartamentos->firstItem() }}</span>
                                    a
                                    <span class="font-medium">{{ $apartamentos->lastItem() }}</span>
                                    de
                                    <span class="font-medium">{{ $apartamentos->total() }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    <a href="{{ $apartamentos->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">anterior</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @for ($i = 1; $i <= $apartamentos->lastPage(); $i++)
                                        <a href="{{ $apartamentos->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $apartamentos->currentPage() == $i ? 'bg-Azul3 text-white' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50' }}">{{ $i }}</a>
                                    @endfor
                                    <a href="{{ $apartamentos->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">Sigiente</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmActivo(id) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡Esto activara el apartamento!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#297EA3",
                cancelButtonColor: "#4A5568",
                confirmButtonText: "Sí, activar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('apartamento.inactive', ':id') }}`.replace(':id', id), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ _method: 'POST' }) // Ajusta esto si el backend necesita algún otro dato
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(text); // Obtén el mensaje de error del servidor
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                        Swal.fire({
                            title: "¡Activado!",
                            text: "El apartamento ha sido activado.",
                            icon: "success"
                        }).then(() => {
                            console.log('Recargando la página...');
                            window.location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error); // Log del error completo
                        Swal.fire({
                            title: "Error",
                            text: `Hubo un problema al activar el apartamento: ${error.message}`,
                            icon: "error"
                        });
                    });
                }
            });
        }
    </script>

</x-app-layout>
