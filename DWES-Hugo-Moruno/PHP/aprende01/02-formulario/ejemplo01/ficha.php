<?php
    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    die();

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";*/

    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $sexo = $_POST['sexo'] ?? '';
    //    $aficiones = $_POST['aficiones'];
    //    $aficiones = isset($_POST['aficiones']) ? $_POST['aficiones'] : [];
    $aficiones = isset($_POST['aficiones']) ?? [];
    $estudios = $_POST['nivel'];
    $observaciones = $_POST['observaciones'];
    $imagen = $_FILES['imagen'] ?? null;

    echo "<pre>";
    echo "<hr>";
    echo "Nombre: " . $nombre . "<br>";
    echo "Apellido 1: " . $apellido1 . "<br>";
    echo "Apellido 2: " . $apellido2 . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Fecha de Nacimiento: " . $fechanacimiento . "<br>";
    echo "Sexo: " . $sexo . "<br>";
    //    echo "Aficiones: " . implode(", ", $aficiones) . "<br>";
    echo "Aficiones: ";
    foreach ($aficiones as $aficion) {
        echo $aficion . "<br>";
    }
    echo "Estudios: " . $estudios . "<br>";
    echo "Obaservaciones: " . $observaciones . "<br>";
    echo "Nombre de la Imagen: " . $imagen . "<br>";
    echo "<hr>";
    echo "</pre>";

    $path = $_SERVER['DOCUMENT_ROOT'];
    echo $path."<br>";
    $localPathImagen = '/'.$imagen['name'];
    $pathImagenes = $path.$localPathImagen;
    echo $pathImagenes."<br>";
    move_uploaded_file($imagen['tmp_name'], $pathImagenes);
    echo "<img src=\"$localPathImagen\" />";
