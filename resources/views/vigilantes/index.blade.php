<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista De Vigilantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('vigilantes.create') }}" class="bg-cyan-500 dark:bg-cyan-700 hover:bg-cyan-600 dark:hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded">Crear vigilante</a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">N. Identificación</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Foto</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Nombre Completo</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Edad</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Cargo</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Direccion</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Tel/Cel</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Jornada</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Fecha Registro</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vigilantes as $vigilante)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->ID_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Foto_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Nombre_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Edad_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Cargo_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Direccion_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Tel_Cel_Vigilante }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Tiempo_trabajo }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $vigilante->Fecha_Registro }}</td>

                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('vigilantes.edit', $vigilante->ID_Vigilante) }}" class="bg-violet-500 dark:bg-violet-700 hover:bg-violet-600 dark:hover:bg-violet-800 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                        <button type="button" class="bg-pink-400 dark:bg-pink-600 hover:bg-pink-500 dark:hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $vigilante->id }}')">Eliminar</button>

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
                    form.action = '/vigilantes/' + id;
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
            form.action = '/vigilantes/' + id;
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
