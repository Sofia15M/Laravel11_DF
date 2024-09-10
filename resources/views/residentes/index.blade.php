<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista De Residentes') }}
        </h2>
    </x-slot>

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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        @if (auth()->user()->id_rol == 1)
                            <a href="{{ route('residentes.create') }}" class="bg-azul dark:bg-azul1 hover:bg-azul1 dark:hover:bg-azul text-white font-bold py-2 px-4 rounded mr-2 mb-2 float-left" title="Añadir registro">
                                <svg class="h-5 w-5 text-gray-100"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />  <circle cx="8.5" cy="7" r="4" />  <line x1="20" y1="8" x2="20" y2="14" />  <line x1="23" y1="11" x2="17" y2="11" /></svg>
                            </a>
                        @endif
                        <a href="{{ route('residentes.inactive') }}" class="bg-naranja dark:bg-naranja1 hover:bg-naranja1 dark:hover:bg-naranja text-white font-bold py-2 px-4 rounded mr-2 mb-2 float-left" title="Desativados">
                            <svg class="h-5 w-5 text-gray-100"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />  <line x1="1" y1="1" x2="23" y2="23" /></svg>
                        </a>
                        <a href="{{ route('residentes.pdf')}}" class="bg-azul dark:bg-azul1 hover:bg-azul1 dark:hover:bg-azul text-white font-bold py-2 px-4 rounded float-right" title="Imprimir" target="_blank">
                            <svg class="h-5 w-5 text-gray-100"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="12" y1="11" x2="12" y2="17" />  <polyline points="9 14 12 17 15 14" /></svg>
                        </a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Identificación</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Foto</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Nombre Completo</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Tel/Cel</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Apartamento</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Fecha Registro</th>
                                @if (auth()->user()->id_rol == 1)
                                    <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($residentes as $residente)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->ID_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                    <img src="{{ asset('storage/' . $residente->Foto_Residente) }}" alt="Foto Residente" class="h-30 w-20 mx-auto">
                                </td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Nombre_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Tel_Cel_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->ID_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Fecha_Registro }}</td>
                                @if (auth()->user()->id_rol == 1)
                                    <td class="border px-4 py-2 text-center">
                                        <div class="flex justify-center">
                                            <a href="{{ route('residentes.edit', $residente->ID_Residente) }}" class="bg-verde dark:bg-verde1 hover:bg-verde dark:hover:bg-verde1 text-white font-bold py-2 px-4 rounded mr-2" title="Editar">
                                                <svg class="h-5 w-5 text-white" <svg  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                            </a>
                                            <button type="button" onclick="confirmDeactivate('{{ $residente->ID_Residente }}')" class="bg-naranja dark:bg-naranja1 hover:bg-naranja1 dark:hover:bg-naranja text-white font-bold py-2 px-4 rounded mr-2" title="Desactivar">
                                                <svg class="h-5 w-5 text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
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
                            <a href="{{ $residentes->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            <a href="{{ $residentes->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando
                                    <span class="font-medium">{{ $residentes->firstItem() }}</span>
                                    a
                                    <span class="font-medium">{{ $residentes->lastItem() }}</span>
                                    de
                                    <span class="font-medium">{{ $residentes->total() }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    <a href="{{ $residentes->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                        <span class="sr-only">anterior</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @for ($i = 1; $i <= $residentes->lastPage(); $i++)
                                        <a href="{{ $residentes->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $residentes->currentPage() == $i ? 'bg-Azul3 text-white' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50' }}">{{ $i }}</a>
                                    @endfor
                                    <a href="{{ $residentes->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
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
        function confirmDeactivate(id) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡Esto desativara el residente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#297EA3",
                cancelButtonColor: "#4A5568",
                confirmButtonText: "Sí, desativar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('residente.index', ':id') }}`.replace(':id', id), {
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
                            title: "¡Desativado!",
                            text: "El residente ha sido desativado.",
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
                            text: `Hubo un problema al desativar el residente: ${error.message}`,
                            icon: "error"
                        });
                    });
                }
            });
        }
    </script>

</x-app-layout>
