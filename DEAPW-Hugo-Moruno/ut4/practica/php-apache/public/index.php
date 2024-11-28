<?php 
    $h1="Git Bare";
    $content="Ésta página está basada en un sistema de repositorios git bare. Versión inicial de la página.";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Git Bare</title>
    <style>
        html, body
        {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        div
        {
            height: fit-content;
            width: 370px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #FFF8DC;
            border: 2px solid lightgreen;
            border-radius: 10px;
        }
        div * 
        {
            margin: 10px 0;
            padding: 0;
        }
        h1
        {
            width: 300px;
            text-align: center;
            color: green;
            background-color: white;
            border: 2px solid lightgreen;
            border-radius: 10px;
            padding: 0 20px;
        }
        p
        {
            width: 300px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div>
        <h1><?php echo $h1 ?></h1>
        <p><?php echo $content ?></p>
    </div>
</body>
</html>