<?php

    require_once 'Dao.php';
    require_once 'Database.php';

    class TraficoDao implements Dao
    {
        public $bd;
        public function __construct()
        {
            $this->bd = Database::connecta();
        }

        public function save($data): int|null
        {
            if(isset($data['id']) && $data['id'] != '')
            {
                return $this->update($data['id'], $data);
            }
            else
            {
                $sentencia = $this->bd->prepare(
                    'INSERT INTO trafico(
                            matricula, modelo, fecha_inscrip, imagen)
                       VALUES (:matricula, :modelo, :fecha_inscrip, :imagen)');
                $sentencia->bindValue(':matricula', $data['matricula'] ?? "", type: SQLITE3_TEXT);
                $sentencia->bindValue(':modelo', $data['modelo'] ?? "", type: SQLITE3_TEXT);
                $sentencia->bindValue(':fecha_inscrip', $data['fecha_inscrip'] ?? "", type: SQLITE3_TEXT);
                $sentencia->bindValue(':imagen', $data['imagen'], type: SQLITE3_TEXT);
                return $sentencia->execute() ? 1 : 0;
            }
        }

        public function findById(int $id): array
        {
            $result = $this->bd->query("SELECT * FROM trafico WHERE id =".$id);
            $data = [];
            while ($trafico = $result->fetchArray(SQLITE3_ASSOC)) {
                $data[] = $trafico;
            }
            return $data;
        }

        public function update(int $id, array $data): bool
        {
            $sentencia = $this->bd->prepare(
                'UPDATE trafico
                SET matricula = :matricula, modelo = :modelo, fecha_inscrip = :fecha_inscrip' .
                ($data['imagen'] != '' ? ', imagen = :imagen' : '') . ' 
                WHERE id = :id;'
            );

            $sentencia->bindValue(':matricula', $data['matricula'] ?? "", SQLITE3_TEXT);
            $sentencia->bindValue(':modelo', $data['modelo'] ?? "", SQLITE3_TEXT);
            $sentencia->bindValue(':fecha_inscrip', $data['fecha_inscrip'] ?? "", SQLITE3_TEXT);

            if ($data['imagen'] != '') {
                $sentencia->bindValue(':imagen', $data['imagen'], SQLITE3_TEXT);
            }

            $sentencia->bindValue(':id', $id, SQLITE3_INTEGER);

            return $sentencia->execute() ? 1 : 0;
        }


        public function findAll(): array|null
        {
            $sentencia = $this->bd->prepare("SELECT * FROM trafico");
            $results = $sentencia->execute();
            $list = [];
            while ($trafico = $results->fetchArray(SQLITE3_ASSOC)) {
                $list[] = $trafico;
            }
            return $list;
        }

        public function delete(int $id): bool
        {
            $sentencia = $this->bd->prepare("DELETE FROM trafico WHERE id =".$id);
            $result = $sentencia->execute();
            return ($result && $this->bd->changes() > 0);
        }
    }