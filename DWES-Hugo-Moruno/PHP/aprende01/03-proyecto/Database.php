<?php

class Database
{
    private static $bd = null;
    /*
    private static $host = 'db';
    private static $dbname = 'traficodb';
    private static $port = 3306;
    private static $username = 'trafico';
    private static $password = 'trafico';
    */

    public static function connecta()
    {
        if (!self::$bd) {

            self::$bd = new SQLite3('dbprueba.db');
            self::$bd -> exec(
                'CREATE TABLE IF NOT EXISTS trafico '.
                '(id INTEGER PRIMARY KEY AUTOINCREMENT, matricula VARCHAR(10), '.
                'modelo VARCHAR(40), fecha_inscrip DATE, '.
                'imagen STRING)'
            );
            return self::$bd;

            //Dejo ésto aquí comentado porque no he conseguido crear el contenedor de docker_lamp.

            /*try {
                $url = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname . ";charset=utf8";
                self::$bd = new PDO($url, self::$username, self::$password);

                self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'CREATE TABLE IF NOT EXISTS trafico '.
                '(id INTEGER PRIMARY KEY AUTOINCREMENT, matricula VARCHAR(10), '.
                'modelo VARCHAR(40), fecha_inscrip DATE, '.
                'imagen STRING)';
                self::$bd->exec($sql);


            } catch (PDOException $e) {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }*/
        }
        return self::$bd;
    }

    // Método para cerrar la conexión
    public static function cierra()
    {
        if (self::$bd)
            self::$bd -> close();
        self::$bd = null;
    }
}
