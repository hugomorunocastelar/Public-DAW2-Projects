<?php
    #Así se declaran las variables en php.
    $nombre = "Pepito";
    $apellido = "Pérez";
    #Así se leen las variables y con el . se concatena (Aquí no se usa el + para concatenar).
    echo $nombre . "<br>";
    echo "Nombre " . $nombre . " Apellido: " . $apellido;
    #Booleans
    $hecho1 = true;
    $hecho2 = false;
    $hecho3 = ""; #Esto también es falso, pero no sirve para transportar datos.
    #Prueba de Null
    $vacio = null;
    echo $vaciodeverdad;
    echo "<br>";
    echo "<hr>";
    echo "Si la variable está definida, el *isset* devuelve un true (primer if)" . "<br>"
    ."y si no está definida, devuelve un false y entra en el else";
    echo "<br>";
    if (isset($vaciodeverdad)){
        echo "Definida";
    } else {
        echo "No definida";
    }
    echo "<br>";
    echo "Saber si la variable es nula, se usa  *isnull()*"."<br>";
    if (is_null($vacio)){
        echo "Está vacía";
    } else {
        echo "No está vacía";
    }
    echo "<br>";
    echo "Saber si la variable está vacia, se usa  *empty()*"."<br>";
    if (empty($vacio)){
        echo "Está vacía";
    } else {
        echo "No está vacía";
    }
    echo "<br>";
    echo "<hr>";
    #OPERADOR TERNARIO "?" DEFINE EL OPERADOR. A CONTINUACIÓN QUÉ OCURRE SI ES TRUE Y : Y LO QUE OCURRE SI ES FALSO;
    echo "Operador ternario"."<br>";
    echo empty($vacio) ? "Si" : "No" ;
    echo "<br>";
    echo empty(!$vacio) ? "Si" : "No" ;

