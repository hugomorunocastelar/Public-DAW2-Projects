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
    <form action="?option=store" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id'] ?? null ?>">
        <header id="cabecero">
            <h1>Formulario de Tráfico</h1>
            <a href="/"><p>Volver</p></a>
        </header>
        <div class="container-form">
            <div class="items-form">
                <label for="matricula">Matrícula</label>
                <input id="matricula" type="text" name="matricula" value="<?= $data['matricula'] ?? '' ?>" placeholder="Matrícula" <?= $data['readonly'] ?? '' ?>>
            </div>
            <div class="items-form">
                <label for="modelo">Modelo:</label>
                <input id="modelo" type="text" name="modelo" value="<?= $data['modelo'] ?? '' ?>" placeholder="Modelo" <?= $data['readonly'] ?? '' ?>>
            </div>
            <div class="items-form">
                <label for="fechaInscrip">Fecha de inscripción:</label>
                <input id="fechaInscrip" type="date" name="fecha_inscrip" value="<?= $data['fecha_inscrip'] ?? '' ?>" <?= $data['readonly'] ?? '' ?>>
            </div>
            <div class="items-form">
                <label for="imagen">Imagen: </label>
                <input id="imagen" type="file" name="imagen"">
                <?php if (isset($data['localPathImagen'])) { ?>
                    <img style="width: 100px" src="<?=$data['localPathImagen']?>">
                <?php } ?>
            </div>
            <div>
                <?php if (!isset($data['readonly'])) { ?>
                    <input type="submit" value="Guardar">
                <?php } ?>
            </div>
        </div>
    </form>
</body>
</html>
