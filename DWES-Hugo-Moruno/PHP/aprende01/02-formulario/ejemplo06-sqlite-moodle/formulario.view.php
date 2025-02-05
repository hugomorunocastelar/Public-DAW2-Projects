
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
            <label for="nombre">Nombre</label>
            <div class="items-form-input">
                <input id="nombre" type="text" name="data[nombre]" value="<?= $data['nombre'] ?>" placeholder="Nombre" <?= $data['readonly'] ?? '' ?>>
            </div>
        </div>
        <div class="items-form">
            <label for="apellidos">Apellidos:</label>
            <input id="apellidos" type="text" name="data[apellidos]" value="<?= $data['apellidos'] ?>">
        </div>
        <div class="items-form">
            <label for="email">Email:</label>
            <input id="email" type="email" name="data[email]" value="<?= $data['email'] ?>">
        </div>
        <div class="items-form">
            <label for="fechaNacimiento">Fecha nacimiento:</label>
            <input id="fechaNacimiento" type="date" name="data[fecha_nacimiento]" value="<?= $data['fecha_nacimiento'] ?>">
        </div>
        <div class="items-form">
            <label>Sexo:</label>
            <div class="items-form-input-group">
                <input type="radio" name="data[sexo]" value="H" <?= $data['sexo'] == 'H'?'checked':'' ?> >Hombre
                <input type="radio" name="data[sexo]" value="M" <?= $data['sexo'] == 'M'?'checked':'' ?>>Mujer
                <input type="radio" name="data[sexo]" value="O" <?= $data['sexo'] == 'O'?'checked':'' ?>>Otro
                <input type="radio" name="data[sexo]" value="X" <?= $data['sexo'] == 'X'?'checked':'' ?>>Prefiero no decirlo
            </div>
        </div>
        <div class="items-form">
            <label>Aficiones:</label>
            <div class="items-form-input-group">
                <input type="checkbox" name="data[aficiones][]" value="INF" <?= in_array('INF', $data['aficiones'])?'checked':'' ?> >Informatica
                <input type="checkbox" name="data[aficiones][]" value="LEC" <?= in_array('LEC', $data['aficiones'])?'checked':'' ?>>Lectura
                <input type="checkbox" name="data[aficiones][]" value="DEP" <?= in_array('DEP', $data['aficiones'])?'checked':'' ?>>Deporte
            </div>
        </div>
        <div class="items-form">
            <label>Nivel de estudios:</label>
            <select name="data[estudios]">
                <option value="" <?= $data['estudios']=='sec'?'selected':'' ?> >Sin especificar</option>
                <option value="sec" <?= $data['estudios']=='sec'?'selected':'' ?> >Secundaria</option>
                <option value="bach" <?= $data['estudios']=='bach'?'selected':'' ?> >Bachillerato</option>
                <option value="tgm" <?= $data['estudios']=='tgm'?'selected':'' ?> >Técnico Grado Medio</option>
                <option value="tgs" <?= $data['estudios']=='tgs'?'selected':'' ?> >Técnico Grado Superior</option>
                <option value="grad" <?= $data['estudios']=='grad'?'selected':'' ?> >Graduado</option>
            </select>
        </div>
        <div class="items-form">
            <label for="nombre">Observaciones:</label>
            <textarea id="observaciones" name="data[observaciones]"><?= $data['observaciones'] ?></textarea>
        </div>
        <div class="items-form">
            <label for="nombre">Imagen:</label>
            <input type="file" id="imagen" name="data[imagen]">
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
