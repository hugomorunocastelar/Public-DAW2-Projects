<?php
interface Dao
{
    public function save($data) : int | null;
    public function update(int $id, array $data) : bool;
    public function findAll() : array | null;
    public function findById(int $id) : array | null;
    public function delete(int $id) : bool;
}
