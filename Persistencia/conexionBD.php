<?php
require_once __DIR__ . '/../Otros/protegerCred.php';

class ConexionBD {
    private static $conn = null;

    public static function conectar() {
        if (self::$conn === null) {
            $host = cargarEnv('DB_HOST', 'localhost');
            $user = cargarEnv('DB_USER', 'root');
            $pass = cargarEnv('DB_PASS', '');
            $db   = cargarEnv('DB_NAME', '');

            self::$conn = new mysqli($host, $user, $pass, $db);
            if (self::$conn->connect_error) {
                die("Error de conexión: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}