<?php
$host = "localhost";
$db   = "tournament-engine";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;port=3307;dbname=$db;charset=utf8",
        $user,
        $pass
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}