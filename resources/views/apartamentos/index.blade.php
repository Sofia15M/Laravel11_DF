<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista De Apartamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('apartamentos.create') }}" class="bg-azul dark:bg-azul1 hover:bg-azul dark:hover:bg-azul1 text-white font-bold py-2 px-4 rounded mr-2 mb-2 float-left" title="Añadir registro">
                            <svg class="h-5 w-5 text-gray-100"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />  <line x1="12" y1="8" x2="12" y2="16" />  <line x1="8" y1="12" x2="16" y2="12" /></svg>
                        </a>
                        <a href="{{ route('apartamentos.inactive') }}" class="bg-naranja dark:bg-naranja1 hover:bg-naranja1 dark:hover:bg-naranja text-white font-bold py-2 px-4 rounded mr-2 mb-2 float-left" title="Desativados">
                            <svg class="h-5 w-5 text-gray-100"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />  <line x1="1" y1="1" x2="23" y2="23" /></svg>
                        </a>
                        <a href="{{ route('apartamentos.pdf')}}" class="bg-azul dark:bg-azul1 hover:bg-azul1 dark:hover:bg-azul text-white font-bold py-2 px-4 rounded float-right" title="Imprimir" target="_blank">
                            <svg class="h-5 w-5 text-gray-100"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="12" y1="11" x2="12" y2="17" />  <polyline points="9 14 12 17 15 14" /></svg>
                        </a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">N. Apartamento</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Descripción</th>
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Propietario</th>
                                @if (auth()->user()->id_rol == 1)
                                    <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apartamentos as $apartamento)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $apartamento->ID_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $apartamento->Descripcion_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $apartamento->ID_Propietario }}</td>
                                @if (auth()->user()->id_rol == 1)
                                    <td class="border px-4 py-2 text-center">
                                        <div class="flex justify-center">
                                            <a href="{{ route('apartamentos.edit', $apartamento->ID_Apartamento) }}" class="bg-verde dark:bg-verde1 hover:bg-verde dark:hover:bg-verde1 text-white font-bold py-2 px-4 rounded mr-2" title="Editar">
                                                <svg class="h-5 w-5 text-white" <svg  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                            </a>
                                            <button type="button" class="bg-naranja dark:bg-naranja1 hover:bg-naranja1 dark:hover:bg-naranja text-white font-bold py-2 px-4 rounded mr-2" onclick="#" title="Desativar">
                                                <svg class="h-5 w-5 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="bg-rojo dark:bg-rojo1 hover:bg-rojo dark:hover:bg-rojo1 text-white font-bold py-2 px-4 rounded mr-2" onclick="confirmDelete('{{ $apartamento->id }}')" title="Eliminar">
                                                <svg class="h-5 w-5 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // forma 1
    function confirmDelete(id) {
        alertify.confirm("¿Confirmar eliminar registro?",
        function(){
            let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/apartamentos/' + id;
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
            alertify.success('Aceptar');
        },
        function(){
            alertify.error('Cancelar');
        });
    }

// forma 2
/* function confirmDelete(id) {
    alertify.confirm("¿Confirm delete record?", function (e) {
        if (e) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/apartamentos/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        } else {
            alertify.error('Cancel');
            return false;
        }
    });
} */
</script>
