<?php

class Conexion
{
    private static $conect = null;

    public function __construct()
    {
        if (self::$conect !== null) {
            return;
        }
        try {
            self::$conect = new PDO(
                "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            http_response_code(500);
            exit(DEBUG ? "Error de conexion: " . $e->getMessage() : "Error de conexion con la base de datos.");
        }
    }

    public function connect()
    {
        return self::$conect;
    }
}
