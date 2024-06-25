<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista De Visitantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('visitantes.create') }}" class="bg-cyan-500 dark:bg-cyan-700 hover:bg-cyan-600 dark:hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded">Crear visitante</a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">N. Identificación</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Foto</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Nombre Completo</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Tel/Cel</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">N. Apartamento</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Hora de Ingreso</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Hora de Salida</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Fecha Registro</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visitantes as $visitante)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->ID_Visitante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->Foto_Visitante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->Nombre_Visitante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->Tel_Cel_Visitante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->ID_Apartamento }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->Hora_Ingreso }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->Hora_Salida }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $visitante->Fecha_Registro }}</td>

                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('visitantes.edit', $visitante->ID_Visitante) }}" class="bg-violet-500 dark:bg-violet-700 hover:bg-violet-600 dark:hover:bg-violet-800 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                        <button type="button" class="bg-pink-400 dark:bg-pink-600 hover:bg-pink-500 dark:hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $visitante->id }}')">Delete</button>

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
                    form.action = '/visitantes/' + id;
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
            form.action = '/visitantes/' + id;
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