<!doctype html>
<html lang="en">
    <head>
        <title>Empleados</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <style>
            h2 {
                font-size: 2rem;
                color: #333;
                text-align: center;
                margin-bottom: 1rem;
                border: 1px solid #ddd;
            }

            table {
                width: 100%;
                border-collapse: collapse; /* Hace que los bordes se colapsen en uno solo */
                margin: 1rem 0;
                font-size: 1rem;
                font-family: Arial, sans-serif;
            }

            th, td {
                padding: 10px;
                border: 1px solid #ddd; /* Aplica bordes a las celdas */
                text-align: left;
            }

            thead {
                background-color: #f4f4f4;
            }

            tr:hover {
                background-color: #f1f1f1;
            }

            img {
                display: block;
                max-width: 100%;
                height: auto;
                border-radius: 50%;
            }
        </style>

    </head>

    <body>
        <h2>Empleados</h2>


        <table>
            <thead>
                <tr>
                    <th>N. Identificación</th>
                    <th>Nombre Completo</th>
                    <th>Cargo</th>
                    <th>Tel/Cel</th>
                    <th>Jornada</th>
                    <th>Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->ID_PersonalL }}</td>
                    <td>{{ $empleado->Nombre_PersonalL }}</td>
                    <td>{{ $empleado->Cargo_PersonalL }}</td>
                    <td>{{ $empleado->Tel_Cel_PersonalL }}</td>
                    <td>{{ $empleado->Tiempo_trabajo }}</td>
                    <td>{{ $empleado->Fecha_Registro }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
