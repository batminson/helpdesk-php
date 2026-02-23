<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket enviado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="max-width:500px; text-align:center">
    <h2>✅ Ticket enviado correctamente</h2>

    <p>Hemos recibido tu solicitud.<br>
    Nuestro técnico te responderá pronto.</p>

    <a href="formulario.php" class="btn volver">Crear otro ticket</a>
</div>

</body>
</html>

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

