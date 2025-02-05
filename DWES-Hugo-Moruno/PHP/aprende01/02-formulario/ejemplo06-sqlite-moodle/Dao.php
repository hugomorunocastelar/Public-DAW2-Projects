<?php
interface Dao
{
    public function save(array $data) : int | null;
    public function update(int $id, array $data) : bool;
    public function findAll() : array;

    public function findById(int $id): array;

}
