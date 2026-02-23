<?php
$host = "sql5.freesqldatabase.com";
$db   = "sql5817833";
$user = "sql5817833";
$pass = "R3fZhGWhbm";
$port = 3306;

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;port=$port;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
