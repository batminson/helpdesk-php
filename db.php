<?php
$host = getenv("mysql.railway.internal");
$db   = getenv("railway");
$user = getenv("root");
$pass = getenv("bFBWXRFNTrnjBxhuGOKYdDQcczhlrYsx");
$port = getenv("3306");

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
