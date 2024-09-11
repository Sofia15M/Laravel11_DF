<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista De Vigilantes Desativados') }}
        </h2>
    </x-slot>

    @if(request()->has('mensaje'))
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                var mensaje = "{{ request('mensaje') }}"; // Esto imprime el valor real del mensaje
                if (mensaje){
                    alert(mensaje); // Esto muestra el mensaje real en la alerta
                }
            });
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('vigilantes.index') }}" title="Volver atras">
                            <svg class="h-8 w-8 text-gray-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="5" y1="12" x2="19" y2="12" />  <line x1="5" y1="12" x2="9" y2="16" />  <line x1="5" y1="12" x2="9" y2="8" /></svg>
                        </a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Identificación</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Foto</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Nombre Completo</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Cargo</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Direccion</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Tel/Cel</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Jornada</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Fecha Registro</th>
                                @if (auth()->user()->id_rol == 1)
                                    <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vigilantes as $vigilante)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->ID_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                    <img src="{{ asset('storage/' . $vigilante->Foto_Vigilante) }}" alt="Foto Vigilante" class="h-30 w-20 mx-auto">
                                </td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Nombre_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Cargo_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Direccion_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Tel_Cel_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Tiempo_trabajo }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Fecha_Registro }}</td>
                                @if (auth()->user()->id_rol == 1)
                                    <td class="border px-4 py-2 text-center">
                                        <div class="flex justify-center">
                                            <button type="button" onclick="confirmActivo('{{ $vigilante->ID_Vigilante }}')" class="bg-verde dark:bg-verde1 hover:bg-verde1 dark:hover:bg-verde text-white font-bold py-2 px-4 rounded mr-2" title="Activar">
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
                            <a href="{{ $vigilantes->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            <a href="{{ $vigilantes->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando
                                    <span class="font-medium">{{ $vigilantes->firstItem() }}</span>
                                    a
                                    <span class="font-medium">{{ $vigilantes->lastItem() }}</span>
                                    de
                                    <span class="font-medium">{{ $vigilantes->total() }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    <a href="{{ $vigilantes->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">anterior</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @for ($i = 1; $i <= $vigilantes->lastPage(); $i++)
                                        <a href="{{ $vigilantes->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $vigilantes->currentPage() == $i ? 'bg-Azul3 text-white' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50' }}">{{ $i }}</a>
                                    @endfor
                                    <a href="{{ $vigilantes->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
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
                text: "¡Esto activara a el vigilante!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#297EA3",
                cancelButtonColor: "#4A5568",
                confirmButtonText: "Sí, activar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('vigilante.inactive', ':id') }}`.replace(':id', id), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ _method: 'POST' })
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
                            text: "El vigilante ha sido activado.",
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
                            text: `Hubo un problema al activar el vigilante: ${error.message}`,
                            icon: "error"
                        });
                    });
                }
            });
        }
    </script>

</x-app-layout>
