<?php
require 'conexion.php';

$nombre   = $_POST['nombre'] ?? '';
$email    = $_POST['email'] ?? '';
$problema = $_POST['problema'] ?? '';

if ($nombre === '' || $email === '' || $problema === '') {
    die('Datos incompletos');
}

$estado = 'Pendiente';

$sql = "INSERT INTO tickets (nombre, email, problema, estado)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre, $email, $problema, $estado);
$stmt->execute();

$stmt->close();
$conn->close();

// Redirigir después de guardar
header("Location: formulario.php?ok=1");
exit;