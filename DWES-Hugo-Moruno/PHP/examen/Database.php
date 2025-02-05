<?php

class Database
{
    private static $bd = null;

    public static function connecta()
    {
        if (!self::$bd) {
            self::$bd = new SQLite3('db_habitaciones.db');
            # Habilita el modo de excepciones en SQLite
            self::$bd->enableExceptions(true);
            self::$bd->exec('
                CREATE TABLE IF NOT EXISTS habitaciones (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    numero VARCHAR(10), 
                    fumador INTEGER, 
                    capacidad INTEGER, 
                    uso INTEGER, 
                    servicios VARCHAR(255), 
                    imagen STRING)');
        }
        return self::$bd;
    }

    public static function cierra()
    {
        if (self::$bd)
            self::$bd->close();
        self::$bd = null;
    }

}
