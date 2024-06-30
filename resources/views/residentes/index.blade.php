<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista De Residentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('residentes.create') }}" class="bg-naranja dark:bg-naranja1 hover:bg-naranja1 dark:hover:bg-naranja text-white font-bold py-2 px-4 rounded">Crear Residente</a>
                        <a href="#" class="bg-azul dark:bg-azul1 hover:bg-azul1 dark:hover:bg-azul text-white font-bold py-2 px-4 rounded float-right" title="Imprimir">
                            <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect x="6" y="14" width="12" height="8" />
                            </svg>
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
                                <th class="border px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($residentes as $residente)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->ID_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Foto_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Nombre_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Tel_Cel_Residente }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->ID_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $residente->Fecha_Registro }}</td>

                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('residentes.edit', $residente->ID_Residente) }}" class="bg-verde dark:bg-verde1 hover:bg-verde dark:hover:bg-verde1 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                        <button type="button" class="bg-rojo dark:bg-rojo1 hover:bg-rojo dark:hover:bg-rojo1 text-white font-bold py-2 px-4 rounded mr-2" onclick="confirmDelete('{{ $residente->id }}')">Delete</button>

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

<script>
    // forma 1
    function confirmDelete(id) {
        alertify.confirm("¿Confirmar eliminar registro?",
        function(){
            let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/residentes/' + id;
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
            form.action = '/residentes/' + id;
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
