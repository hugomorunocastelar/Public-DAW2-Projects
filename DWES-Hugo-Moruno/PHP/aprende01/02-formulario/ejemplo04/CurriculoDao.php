<?php

require_once "./Database.php";

class CurriculoDao
{
    public $bd;

    public function __construct()
    {
        $this->bd = Database::connecta();
    }

    public function save($data)
    {
        $sentencia = $this->bd->prepare(
            'INSERT INTO curriculos(
                            nombre, apellido1, apellido2, email, fecha_nacimiento, sexo, aficiones,
                            estudios, observaciones, imagen)
                       VALUES (:nombre, :apellido1 , :apellido2, :email, :fecha_nacimiento, :sexo,
                            :aficiones, :estudios, :observaciones, :imagen)');
        $sentencia->bindValue(':nombre', $data['nombre'] ?? "", type: SQLITE3_TEXT);
        $sentencia->bindValue(':apellido1', $data['apellido1'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':apellido2', $data['apellido2'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':email', $data['email'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':fecha_nacimiento', $data['fecha_nacimiento'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':sexo', $data['sexo'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':aficiones', $data['aficiones'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':estudios', $data['estudios'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':observaciones', $data['observaciones'] ?? '', type: SQLITE3_TEXT);
        $sentencia->bindValue(':imagen', $data['imagen'] ?? '', type: SQLITE3_TEXT);
        $sentencia->execute();
    }

    public function findAll()
    {
        $results = $this->bd->query("SELECT * FROM curriculos");
        $list = [];
        while ($curriculo = $results->fetchArray(SQLITE3_ASSOC)) {
            $list[] = $curriculo;
        }
    }
}