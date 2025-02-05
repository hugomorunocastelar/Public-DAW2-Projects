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

<a href="?option=create"  style="background-color: #bd2020; padding: 10px; border-radius: 5px; color: #ffffff">Nuevo</a>
<br><br>
<table style="width: 100%">
    <thead>
    <th style="font-weight: bold">Nº de habitación</th>
    <th style="font-weight: bold">Capacidad</th>
    <th style="font-weight: bold">Servicios</th>
    <th></th>
    </thead>
    <tbody>
    <?php foreach ($data['habitaciones'] as $habitacion) { ?>
            <tr>
                <td> <?= $habitacion['numero'] ?></td>
                <td> <?= $habitacion['capacidad'] ?></td>
                <td> <?= $habitacion['servicios'] ?></td>
                <td>
                    <a href="?option=show&id=<?=$habitacion['id']?>">ver</a> &nbsp;
                    <a href="?option=edit&id=<?=$habitacion['id']?>">editar</a> &nbsp;
                    <a href="?option=delete&id=<?=$habitacion['id']?>">borrar</a> &nbsp;
                </td>
            </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>