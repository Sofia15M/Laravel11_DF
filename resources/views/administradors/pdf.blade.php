<!doctype html>
<html lang="en">
    <head>
        <title>Administradores</title>
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

        <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    </head>

    <body>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th">N. Identificación</th>
                    <th">Foto</th>
                    <th">Nombre Completo</th>
                    <th">Tel/Cel</th>
                    <th">Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($administradors as $administrador)
                <tr>
                    <td">{{ $administrador->ID_Administrador }}</td>
                    <td">{{ $administrador->Foto_Administrador }}</td>
                    <td">{{ $administrador->Nombre_Administrador }}</td>
                    <td">{{ $administrador->Tel_Cel_Administrador }}</td>
                    <td">{{ $administrador->Fecha_Registro }}</td>
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
