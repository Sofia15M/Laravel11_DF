<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Crear Nuevo Administrador') }}
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

                        <form method="POST" action="{{ route('administradors.store') }}" class="max-w-sm mx-auto" enctype="multipart/form-data" onsubmit="return validateForm(event)">
                            @csrf

                            <div class="mb-5">
                                <label for="ID_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificación:</label>
                                <input type="text" name="ID_Administrador" id="ID_Administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Nombre_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo:</label>
                                <input type="text" name="Nombre_Administrador" id="Nombre_Administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Foto_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Administrador</label>
                                <input type="file" id="Foto_Administrador" name="Foto_Administrador" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Edad_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad:</label>
                                <input type="text" name="Edad_Administrador" id="Edad_Administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Cargo_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo:</label>
                                <input type="text" name="Cargo_Administrador" id="Cargo_Administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Direccion_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion:</label>
                                <input type="text" name="Direccion_Administrador" id="Direccion_Administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Tel_Cel_Administrador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de contacto:</label>
                                <input type="text" name="Tel_Cel_Administrador" id="Tel_Cel_Administrador" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="Tiempo_trabajo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jornada:</label>
                                <input type="text" name="Tiempo_trabajo" id="Tiempo_trabajo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            <div class="mb-5">
                                <label for="ID_UNIDAD" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N. Identificacion Unidad:</label>
                                <input type="text" name="ID_UNIDAD" id="ID_UNIDAD" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>


                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                            <a href="{{ route('administradors.index') }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Cancelar</a>
                        </form>


            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function validateForm(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        const idAdministrador = document.getElementById('ID_Administrador').value;

        // Simulación de la validación del ID (reemplaza esta lógica con la real)
        const idExiste = checkIfIdExists(idAdministrador);

        if (idExiste) {
            errorId(idAdministrador);
            return false; // Evitar que el formulario se envíe
        }

        // Si el ID no existe, permitir el envío del formulario
        event.target.submit();
    }

    // Función simulada para verificar si el ID ya existe
    function checkIfIdExists(id) {
        // Aquí deberías hacer la validación real, por ejemplo, una llamada AJAX al servidor.
        // Por ahora, simulemos que el ID "12345" ya existe.
        const idsExistentes = ['12345', '67890']; // Ejemplo de IDs existentes
        return idsExistentes.includes(id);
    }

    function errorId(ID_Administrador) {
        Swal.fire({
            icon: "error",
            title: "ID Duplicado",
            text: `El ID "${ID_Administrador}" ya está registrado. Por favor, ingrese un ID diferente.`,
            footer: '<a href="#">¿Necesitas ayuda?</a>',
            confirmButtonText: "Entendido",
            customClass: {
                confirmButton: 'bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
            }
        });
    }
</script>

