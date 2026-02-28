<?php

class Database {
    private static $host = "localhost";
    private static $db   = "tournament-engine";
    private static $user = "root";
    private static $pass = "";

    public static function connect() {
        try {
            $conn = new PDO(
                "mysql:host=" . self::$host . ";port=3307;dbname=" . self::$db .";charset=utf8",
                self::$user,
                self::$pass
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $conn;

        } catch (PDOException $e) {
            die("Erro na conexão com o banco: " . $e->getMessage());
        }
    }
}
