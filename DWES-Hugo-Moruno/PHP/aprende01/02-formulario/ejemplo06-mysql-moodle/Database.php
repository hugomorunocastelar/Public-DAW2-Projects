<?php

class Database
{
    private static $bd = null;
    private static $host = 'db';
    private static $dbname = 'dwesv';
    private static $port = 3306;
    private static $username = 'dwesv';
    private static $password = 'castelar';


    public static function connecta()
    {
        if (!self::$bd) {
            try {
                $url = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname . ";charset=utf8";
                self::$bd = new PDO($url, self::$username, self::$password);

                // Configurar PDO para que lance excepciones en caso de error
                self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // No necesario para  mysql, se se suele crear en ejecución

                // Crear la tabla si no existe
                $sql = 'CREATE TABLE IF NOT EXISTS curriculos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(20) NOT NULL,
                    apellidos VARCHAR(40) NOT NULL,
                    email VARCHAR(255) UNIQUE,
                    fecha_nacimiento DATE,
                    sexo CHAR(1),
                    aficiones VARCHAR(255),
                    estudios VARCHAR(255),
                    observaciones TEXT,
                    imagen VARCHAR(255)
                )';
                self::$bd->exec($sql);


            } catch (PDOException $e) {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }
        }
        return self::$bd;
    }

    // Método para cerrar la conexión
    public static function cierra()
    {
        self::$bd = null; // PDO se cierra automáticamente al asignar null
    }
}
