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

    public function save($data): int | null
    {
        # Si es cadena vacia se inserta null. Especialmente importante para fecha
        $data['nombre'] = isset($data['nombre']) && trim($data['nombre'])!=""?$data['nombre']:null;
        $data['apellidos'] = isset($data['apellidos']) && trim($data['apellidos'])!=""?$data['apellidos']:null;
        $data['email'] = isset($data['email']) && trim($data['email'])!=""?$data['email']:null;
        // ...
        $data['fecha_nacimiento'] = isset($data['fecha_nacimiento']) && trim($data['fecha_nacimiento'])!=""?$data['fecha_nacimiento']:null;

        $id = null;
        try {
            $sentencia = $this->bd->prepare("INSERT INTO curriculos (nombre, apellidos, email, fecha_nacimiento, sexo, aficiones, estudios, observaciones, imagen) VALUES (:nombre, :apellidos, :email, :fecha_nacimiento, :sexo, :aficiones, :estudios, :observaciones, :imagen)");

            $sentencia->bindValue(':nombre', $data['nombre'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':apellidos', $data['apellidos'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':fecha_nacimiento', $data['fecha_nacimiento'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':sexo', $data['sexo'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':aficiones', $data['aficiones'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':estudios', $data['estudios'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':observaciones', $data['observaciones'] ?? null, PDO::PARAM_STR);
            $sentencia->bindValue(':imagen', $data['imagen'] ?? null, PDO::PARAM_STR);

            $sentencia->execute();
            $id = $this->bd->lastInsertId(); // Obtiene el último ID insertado
        } catch (PDOException $e) {
            error_log("Error al guardar curriculo: " . $e->getMessage());
        }
        return $id;
    }

    public function findAll(): array
    {
        $result = $this->bd->query('SELECT * FROM curriculos');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $sentencia = $this->bd->prepare('SELECT * FROM curriculos WHERE id = :id');
        $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
        return true;
    }
}
