<?php
require_once 'Dao.php';
require_once 'Database.php';

class HabitacionDao implements Dao
{
    public $bd;

    public function __construct()
    {
        $this->bd = Database::connecta();
    }

    public function save(array $data): int|null
    {
        $id = null;
        try {
            # No verifica que nombre y apellidos sea vacio
            $sentencia = $this->bd->prepare("

            INSERT INTO habitaciones (numero, fumador, capacidad, uso, servicios, imagen) 
            VALUES (:numero, :fumador, :capacidad, :uso, :servicios, :imagen)");

            $sentencia->bindValue(':numero', $data['numero'] ?? null, SQLITE3_TEXT);
            $sentencia->bindValue(':fumador', $data['fumador'] ?? null, SQLITE3_INTEGER);
            $sentencia->bindValue(':capacidad', $data['capacidad'] ?? null, SQLITE3_INTEGER);
            $sentencia->bindValue(':uso', $data['uso'] ?? null, SQLITE3_INTEGER);

            $serviciosStr = isset($data['servicios']) ? implode(',', $data['servicios']) : null;

            $sentencia->bindValue(':servicios', $serviciosStr, SQLITE3_TEXT);
            $sentencia->bindValue(':imagen', $data['imagen'] ?? null, SQLITE3_TEXT);
            $sentencia->execute();
            $id = $this->bd->lastInsertRowID();
        } catch (Exception $e) {
            error_log($e);
        }
        return $id;
    }

    public function update(int $id, array $data): bool
    {
        $updated = false;
        try {
            $row = $this->findById($data['id']);
            if ($row != null) {
                $row['numero'] = $data['numero'];
                $row['fumador'] = $data['fumador'];
                $row['capacidad'] = $data['capacidad'];
                $row['uso'] = $data['uso'];
                $row['servicios'] = $data['servicios'];
                $row['imagen'] = $data['imagen'];

                $sentencia = $this->bd->prepare(
                    "UPDATE habitaciones SET " .
                    "numero = :numero, " .
                    "fumador = :fumador, " .
                    "capacidad = :capacidad, " .
                    "uso = :uso, " .
                    "servicios = :servicios, " .
                    "imagen = :imagen " .
                    "WHERE id = :id");
                $sentencia->bindValue(':numero', $data['numero'] ?? null, SQLITE3_TEXT);
                $sentencia->bindValue(':fumador', $data['fumador'] ?? null, SQLITE3_INTEGER);
                $sentencia->bindValue(':capacidad', $data['capacidad'] ?? null, SQLITE3_INTEGER);
                $sentencia->bindValue(':uso', $data['uso'] ?? null, SQLITE3_INTEGER);

                $serviciosStr = isset($data['servicios']) ? implode(',', $data['servicios']) : null;

                $sentencia->bindValue(':servicios', $serviciosStr, SQLITE3_TEXT);
                $sentencia->bindValue(':imagen', $data['imagen'] ?? null, SQLITE3_TEXT);
                $sentencia->execute();
            }
            $updated = false;
        } catch (Exception $e) {
            error_log($e);
        }
        return $updated;
    }

    public function findAll(): array
    {
        $result = $this->bd->query('SELECT * FROM habitaciones');
        $list = [];
        while ($habitacion = $result->fetchArray(SQLITE3_ASSOC)) {
            $list[] = $habitacion;
        }
        return $list;
    }

    public function findById(int $id): array
    {
        $result = $this->bd->query('SELECT * FROM habitaciones where id = ' . $id);
        $data = [];
        while ($habitacion = $result->fetchArray(SQLITE3_ASSOC)) {
            $data = $habitacion;
        }
        return $data;
    }

    public function deleteById(int $id): bool
    {
        $deleted = false;
        try {
            $sentencia = $this->bd->prepare("DELETE FROM habitaciones WHERE id =" . $id);
            $sentencia->execute();
            $deleted = true;
        } catch (Exception $e) {
            error_log($e);
        }
        return $deleted;
    }

}
