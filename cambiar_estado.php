<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (!isset($_GET['id'], $_GET['estado'])) {
    header("Location: lista.php");
    exit;
}

$id = (int) $_GET['id'];
$estado = $_GET['estado'];

/* 1️⃣ Actualizar estado */
$stmt = $db->prepare("UPDATE tickets SET estado = :estado WHERE id = :id");
$stmt->bindValue(':estado', $estado, SQLITE3_TEXT);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

/* 2️⃣ Obtener datos del ticket */
$ticket = $db->querySingle(
    "SELECT nombre, email, problema FROM tickets WHERE id = $id",
    true
);

/* 3️⃣ Enviar correo */
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';     // CAMBIA si usas otro
    $mail->SMTPAuth = true;
    $mail->Username = '75e3da84e9e526';
    $mail->Password = 'e3d75e9bdd7932';
    $mail->Port = 2525;

    $mail->setFrom('soporte@tusitio.com', 'Soporte');
    $mail->addAddress($ticket['email'], $ticket['nombre']);

    $mail->isHTML(true);
    $mail->Subject = "Actualización de tu ticket TCK-$id";
    $mail->Body = "
        <h3>Hola {$ticket['nombre']}</h3>
        <p>Tu ticket ha cambiado de estado.</p>
        <p><strong>Nuevo estado:</strong> $estado</p>
        <p><strong>Problema:</strong> {$ticket['problema']}</p>
        <br>
        <p>Soporte Técnico</p>
    ";

    $mail->send();
} catch (Exception $e) {
    // No rompemos la app si falla el correo
}

/* 4️⃣ Volver a la lista */
header("Location: lista.php");
exit;
