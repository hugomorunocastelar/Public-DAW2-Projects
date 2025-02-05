<?php

class Database
{
    private static $bd = null;

    public static function connecta()
    {
        if (!self::$bd) {
            self::$bd = new SQLite3('db_curriculo.db');
            # Habilita el modo de excepciones en SQLite
            self::$bd->enableExceptions(true);
            self::$bd->exec('CREATE TABLE IF NOT EXISTS curriculos (id INTEGER PRIMARY KEY AUTOINCREMENT, nombre VARCHAR(20) NOT NULL, apellidos VARCHAR(40) NOT NULL, email STRING UNIQUE, fecha_nacimiento DATE, sexo CHAR(1), aficiones VARCHAR(255), estudios VARCHAR(255), observaciones TEXT, imagen STRING)');
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
