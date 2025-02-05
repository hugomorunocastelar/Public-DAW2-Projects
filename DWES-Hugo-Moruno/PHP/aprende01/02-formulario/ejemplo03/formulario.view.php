<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Formulario</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>

        <?php if ($msg) { ?>
            <p class="msg">
                <?= $msg ?>
            </p>
        <?php } ?>

        <form class="formulario" action="formulario.php" method="post" enctype="multipart/form-data">
            <div>
                <h1>FORMULARIO DE CV</h1>
                <div>
                    <label for="nombre">Nombre: </label>
                    <input id="nombre" type="text" name="nombre"
                    value="<?= $nombre ?>" <?= $readonly ?>>
                </div>
                <div>
                    <label for="apellido1">Primer Apellido: </label>
                    <input id="apellido1" type="text" name="apellido1"
                           value="<?= $apellido1 ?>" <?= $readonly ?>>
                </div>
                <div>
                    <label for="apellido2">Segundo Apellido: </label>
                    <input id="apellido2" type="text" name="apellido2"
                           value="<?= $apellido2 ?>" <?= $readonly ?>>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input id="email" type="email" name="email"
                           value="<?= $email ?>" <?= $readonly ?>>
                </div>
                <div>
                    <label for="fechanacimiento">Primer Apellido: </label>
                    <input id="fechanacimiento" type="date" name="fechanacimiento"
                           value="<?= $fechanacimiento ?>" <?= $readonly ?>>
                </div>
                <div>
                    <label>Sexo:</label>
                    <div>
                        <input type="radio" value="H" name="sexo"
                            <?= $sexo == 'H' ? 'checked' : '' ?> <?= $readonly ?>> Hombre
                        <input type="radio" value="M" name="sexo"
                            <?= $sexo == 'M' ? 'checked' : '' ?> <?= $readonly ?>> Mujer
                        <input type="radio" value="O" name="sexo"
                            <?= $sexo == 'O' ? 'checked' : '' ?> <?= $readonly ?>> Otro
                        <input type="radio" value="X" name="sexo"
                            <?= $sexo == 'X' ? 'checked' : '' ?> <?= $readonly ?>> Prefiero no decirlo
                    </div>
                </div>

                <div>
                    <label for="aficiones">Aficiones:</label>
                        <input id="aficiones" type="checkbox" value="INF" name="aficiones[]"
                            <?= in_array('INF', $aficiones) ? 'checked' : '' ?>> Informática
                        <input id="aficiones" type="checkbox" value="LEC" name="aficiones[]"
                            <?= in_array('LEC', $aficiones) ? 'checked' : '' ?>> Lectura
                        <input id="aficiones" type="checkbox" value="DEP" name="aficiones[]"
                            <?= in_array('DEP', $aficiones) ? 'checked' : '' ?>> Deporte
                    </label>
                </div>


                <div>
                    <label for="nivel">Nivel de estudios:</label>
                    <select id="nivel" name="nivel">
                        <option value="tgm" <?= $estudios == 'tgm' ? 'checked' : '' ?>>Técnico Grado Medio</option>
                        <option value="tgs" <?= $estudios == 'tgs' ? 'checked' : '' ?>>Técnico Grado Superior</option>
                        <option value="grad" <?= $estudios == 'grad' ? 'checked' : '' ?>>Graduado</option>
                    </select>
                </div>
                <div>
                    <label for="observaciones">Observaciones</label>
                    <textarea id="observaciones" name="observaciones"><?= $observaciones ?></textarea>
                </div>
                <div>
                    <label for="imagen">Imagen: </label>
                    <input id="imagen" type="file" name="imagen">
                </div>
                <?php if ($localPathImagen != null) { ?>
                    <img src="<?=$localPathImagen?>">
                <?php } ?>
                <div class="button-div">
                    <br>
                    <input type="submit" value="Enviar">
                </div>
            </div>
        </form>
    </body>
</html>