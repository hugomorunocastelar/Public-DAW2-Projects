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
    <input type="hidden" name="data[id]" value="<?= $data['id'] ?>">
    <div class="container-form">
        <div class="items-form">
            <label for="numero">Nº de Habitación</label>
            <div class="items-form-input">
                <input id="numero" type="text" name="data[numero]" value="<?= $data['numero'] ?>" placeholder="Nº de Habitación" <?= $data['readonly'] ?? '' ?>>
            </div>
        </div>
        <div class="items-form">
            <label>Fumador:</label>
            <input type="checkbox" name="data[fumador]" value="fumador" <?= $data['fumador']?'checked':'' ?> <?= $data['readonly'] ?? '' ?>>
        </div>
        <div class="items-form">
            <label for="capacidad">Capacidad:</label>
            <input id="capacidad" type="number" name="data[capacidad]" value="<?= $data['capacidad'] ?>" <?= $data['readonly'] ?? '' ?>>
        </div>
        <div class="items-form">
            <label>Uso:</label>
            <select name="data[uso]" <?= $data['readonly'] ?? '' ?>>
                <option value="0" <?= $data['uso']==0?'selected':'' ?> >No definido</option>
                <option value="1" <?= $data['uso']==1?'selected':'' ?> >Individual</option>
                <option value="2" <?= $data['uso']==2?'selected':'' ?> >Doble</option>
            </select>
        </div>
        <div class="items-form">
            <label>Servicios:</label>
            <div class="items-form-input-group" >
                <input type="checkbox" name="data[servicios][]" value="WIF" <?= in_array('WIF', $data['servicios'])?'checked':'' ?> <?= $data['readonly'] ?? '' ?>>Wifi
                <input type="checkbox" name="data[servicios][]" value="ALB" <?= in_array('ALB', $data['servicios'])?'checked':'' ?> <?= $data['readonly'] ?? '' ?>>Albornoz
                <input type="checkbox" name="data[servicios][]" value="PCK" <?= in_array('PCK', $data['servicios'])?'checked':'' ?> <?= $data['readonly'] ?? '' ?>>Pack Bienvenida
            </div>
        </div>
        <div class="items-form">
            <label for="nombre">Imagen:</label>
            <input type="file" id="imagen" name="imagen" <?= $data['readonly'] ?? '' ?>>
            <img src="<?=$data['localPathImagen'] ?>" >
        </div>
        <div>
            <?php if (!isset($data['readonly'])) { ?>
                <input type="submit" value="Guardar" <?= $data['readonly'] ?? '' ?>>
            <?php } ?>
        </div>
    </div>
</form>


</body>
</html>
