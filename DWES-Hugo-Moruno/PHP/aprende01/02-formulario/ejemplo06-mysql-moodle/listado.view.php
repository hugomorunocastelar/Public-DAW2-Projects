<!doctype html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<a href="?option=create">Nuevo</a>
<table style="width: 100%">
    <thead>
    <th style="font-weight: bold">Nombre</th>
    <th style="font-weight: bold">Apellidos</th>
    <th style="font-weight: bold">Fecha nac.</th>
    <th></th>
    </thead>
    <tbody>
    <?php foreach ($data['curriculos'] as $curriculo) { ?>
            <tr>
                <td> <?= $curriculo['nombre'] ?></td>
                <td> <?= $curriculo['apellidos'] ?></td>
                <td>
                    <?= $curriculo['fecha_nacimiento']?date('d/m/Y',strtotime($curriculo['fecha_nacimiento'])):'' ?>
                </td>
                <td>
                    <a href="?option=show&id=<?=$curriculo['id']?>">ver</a> &nbsp;
                    <a href="?option=edit&id=<?=$curriculo['id']?>">editar</a> &nbsp;
                    <a href="?option=delete&id=<?=$curriculo['id']?>">borrar</a> &nbsp;
                </td>
            </tr>
    <?php } ?>
    </tbody>
</table>


</body>
</html>