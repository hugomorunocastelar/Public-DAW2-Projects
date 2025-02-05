<?php
interface Dao
{
    public function save($data) : int | null;
    public function findAll() : array;

    public function findById(int $id): array | null;

}
