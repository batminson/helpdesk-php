<?php
require 'db.php';

$nombre   = $_POST['nombre'] ?? '';
$email    = $_POST['email'] ?? '';
$problema = $_POST['problema'] ?? '';

$stmt = $db->prepare("
    INSERT INTO tickets (nombre, email, problema, estado)
    VALUES (:nombre, :email, :problema, 'Pendiente')
");

$stmt->bindValue(':nombre', $nombre);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':problema', $problema);
$stmt->execute();

echo "<h2>Ticket creado correctamente</h2>";
echo "<a href='lista.php'>Ver tickets</a>";
