<?php
require_once 'Dao.php';
require_once 'Database.php';
class CurriculoDao implements Dao
{
    public $bd;
    public function __construct()
    {
        $this->bd = Database::connecta();
    }

    public function save(array $data) : int | null
    {
        $id = null;
        try {
            # No verifica que nombre y apellidos sea vacio
            $sentencia = $this->bd->prepare("INSERT INTO curriculos (nombre, apellidos, email, fecha_nacimiento, sexo, aficiones, estudios, observaciones, imagen) VALUES (:nombre, :apellidos, :email, :fecha_nacimiento, :sexo, :aficiones, :estudios, :observaciones, :imagen)");
            $sentencia->bindValue(':nombre', $data['nombre'] ?? '', SQLITE3_TEXT);
            $sentencia->bindValue(':apellidos', $data['apellidos'] ?? '', SQLITE3_TEXT);
            $sentencia->bindValue(':email', $data['email'] ?? '', SQLITE3_TEXT);
            $sentencia->bindValue(':fecha_nacimiento', $data['fecha_nacimiento'] ?? '', SQLITE3_TEXT);
            $sentencia->bindValue(':sexo', $data['sexo'] ?? '', SQLITE3_TEXT);
            $aficionesStr = isset($data['aficiones']) ? implode(',',$data['aficiones']):'';
            $sentencia->bindValue(':aficiones',$aficionesStr, SQLITE3_TEXT);
            $sentencia->bindValue(':estudios', $data['estudios'] ?? '', SQLITE3_TEXT);
            $sentencia->bindValue(':observaciones', $data['observaciones'] ?? '', SQLITE3_TEXT);
            $sentencia->bindValue(':observaciones', $data['imagen'] ?? '', SQLITE3_TEXT);
            $sentencia->execute();
            $id = $this->bd->lastInsertRowID();  // Devuelve el id
        } catch (Exception $e) {
            error_log($e);
        }
        return $id;
    }

    /**
     * Implementar las siguientes correcciones:
     * Corregir el error producido si no se rellenan todos los campos
     * No se debe permitir nombre y/o apellidos vacio.
     * En lugar de cadenas vacias se guardarán null
     * Definir un nuevo método update denominado update2 en el que si un campo si algún campo se pasa como null se deja su valor anterior, si se pasa como '' se almacena como null
     */
    public function update(int $id, array $data) : bool
    {
        $updated = false;
        try {
            $row = $this->findById($data['id']);
            if ($row!=null) {
                $row['nombre'] = $data['nombre'];
                $row['apellidos'] = $data['apellidos'];
                $row['email'] = $data['email'];
                $row['fecha_nacimiento'] = $data['fecha_nacimiento'];
                $row['sexo'] = $data['sexo'];
                $row['aficiones'] = $data['aficiones'];
                $row['estudios'] = $data['estudios'];
                $row['observaciones'] = $data['observaciones'];
                $row['imagen'] = $data['imagen'];

                $sentencia = $this->bd->prepare(
                    "UPDATE curriculos SET ".
                    "nombre = :nombre, ".
                    "apellidos = :apellidos, ".
                    "email = :email, ".
                    "fecha_nacimiento = :fecha_nacimiento, ".
                    "sexo = :sexo, ".
                    "aficiones = :aficiones, ".
                    "estudios = :estudios, ".
                    "observaciones = :observaciones, ".
                    "imagen = :imagen ".
                    "WHERE id = :id");
                $sentencia->bindValue(':id', $id, SQLITE3_TEXT);
                $sentencia->bindValue(':nombre', $row['nombre'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':apellidos', $row['apellidos'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':email', $row['email'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':fecha_nacimiento', $row['fecha_nacimiento'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':sexo', $row['sexo'] ?? null, SQLITE3_TEXT);
                $aficionesStr = isset($row['aficiones']) ? implode(',',$row['aficiones']):null;
                $sentencia->bindValue(':aficiones',$aficionesStr, SQLITE3_TEXT);
                $sentencia->bindValue(':estudios', $row['estudios'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':observaciones', $row['observaciones'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':imagen', $row['imagen'] ?? null, SQLITE3_TEXT);
                $sentencia->execute();
            }
            $updated = false;
        } catch (Exception $e) {
            error_log($e);
        }
        return $updated;
    }

    public function findAll() : array
    {
        $result = $this->bd->query('SELECT * FROM curriculos');
        $list =  [];
        while ($curriculo = $result->fetchArray(SQLITE3_ASSOC)) {
            $list[] = $curriculo;
        }
        return $list;
    }

    public function findById(int $id): array
    {
        $result = $this->bd->query('SELECT * FROM curriculos where id = '.$id);
        $data = [];
        while ($curriculo = $result->fetchArray(SQLITE3_ASSOC)) {
            $data = $curriculo;
        }
        return $data;
    }
}
