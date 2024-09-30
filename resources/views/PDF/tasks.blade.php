<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Tareas Realizadas</title>
    <style>
        * {
            font-family: 'Arial', sans-serif;
        }

        .header {
            width: 100%;
            border: solid 1px black;
            border-spacing: 20px 0;
            padding: 10px;

            margin-bottom: 10px;
        }

        .header .logo {
            width: 150px;
        }

        .header .logo img {
            width: 100%;
        }

        .header-info {
            border-spacing: 20px 0;
        }

        .header h1 {
            font-weight: bold;
            font-size: 18px;
        }

        .header-tables {
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
        }

        .header-tables td, .header-tables tr {
            border: solid 1px black;
        }

        .header-tables td {
            padding: 2px 5px;
        }

        .header-tables tr td:first-child {
            background: #002883;
            color: white;
            text-align: right;
        }

        .project {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .project tr, .project td, .project th {
            border: solid 1px black;
            font-size: 14px;
        }

        .project .header-project {
            background: #002883;
            color: white;
        }

        .project th {
            text-align: center;
            background: #e3e3e3;
        }

        .project-footer td:nth-child(3) {
            text-align: right;
            padding-right: 10px;
        }

        .project-footer tr, .project-footer td, .project-footer th {
            border: none;
        }

        .project-footer {
            border: none !important;
        }

        .project-footer .total {
            padding: 5px;
            border: solid 1px black;
        }

        .title-page {
            width: 100%;
            text-align: center;
        }

        .title-page h2 {
            display: inline;
            font-size: 18px;
            color: #002883;

            border: solid 1px black;
            padding: 5px 30px;

        }

        .empty-file {
            font-size: 14px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<table class="header">
    <tr>
        <td class="logo"><img
                src="data:image/png;base64,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"
                alt="Logotipo"></td>
        <td>
            <table class="header-info">
                <tr>
                    <td colspan="2"><h1>1 - SOLUCIONES INFORMÁTICAS MJ S.C.A.</h1></td>
                </tr>
                <tr>
                    <td>
                        <table class="header-tables">
                            <tr>
                                <td>DESDE FECHA</td>
                                <td>{{ $data['initDate'] }}</td>
                            </tr>

                            <tr>
                                <td>HASTA FECHA</td>
                                <td>{{ $data['endDate'] }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="header-tables">
                            <tr>
                                <td>PROYECTO</td>
                                <td>{{ $data['project'] }}</td>
                            </tr>

                            <tr>
                                <td>USUARIO</td>
                                <td>{{ $user['name'] }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="title-page">
    <tr>
        <td><h2>INFORME DE TAREAS REALIZADAS</h2></td>
    </tr>
</table>
@if(count($projects) === 0)
    <table>
        <tr>
            <td colspan="6">
                <p class="empty-file" ">Este usuario no tiene ninguna tarea asignada al proyecto o proyectos seleccionados en las fechas
                    seleccionadas</p>
            </td>
        </tr>
    </table>
@endif

@foreach($projects as $project)
    <table class="project">
        <tr>
            <th colspan="6">{{ $project['name'] }}</th>
        </tr>

        <tr class="header-project">
            <td>ID</td>
            <td>INICIO</td>
            <td>FIN</td>
            <td>MIN.</td>
            <td>USUARIO</td>
            <td>TAREA REALIZADA</td>
        </tr>

        @foreach($project['tasks'] as $task)
            <tr>
                <td>{{ $task['id'] }}</td>
                <td>{{ $task['start_time'] }}</td>
                <td>{{ $task['end_time'] }}</td>
                <td>{{ $task['duration'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $task['description'] }}</td>
            </tr>
        @endforeach
        <tr class="project-footer">
            <td></td>
            <td></td>
            <td>TOTAL MINS.:</td>
            <td><p class="total">{{ $project['totalDuration'] }}</p></td>
            <td></td>
            <td></td>
        </tr>

    </table>
@endforeach
</body>
</html>

