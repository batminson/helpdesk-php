<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

/* =========================
   CAMBIO DE ESTADO
========================= */

if (!isset($_GET['id'], $_GET['estado'])) {
    header("Location: lista.php");
    exit;
}

$id = (int) $_GET['id'];
$estado = $_GET['estado'];

$stmt = $db->prepare("UPDATE tickets SET estado = :estado WHERE id = :id");
$stmt->bindValue(':estado', $estado, SQLITE3_TEXT);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$stmt->execute();

/* =========================
   OBTENER DATOS DEL TICKET
========================= */

$ticket = $db->querySingle(
    "SELECT nombre, email, problema FROM tickets WHERE id = $id",
    true
);

/* =========================
   ENVÍO DE CORREO (SEGURO)
========================= */

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';   // CAMBIA SI USAS OTRO
    $mail->SMTPAuth = true;
    $mail->Username = '75e3da84e9e526';
    $mail->Password = 'e3d75e9bdd7932';
    $mail->Port = 2525;
    $mail->SMTPDebug = 0; // MUY IMPORTANTE

    $mail->setFrom('soporte@helpdesk.com', 'Soporte Técnico');
    $mail->addAddress($ticket['email'], $ticket['nombre']);

    $mail->isHTML(true);
    $mail->Subject = "Actualización de tu ticket TCK-$id";
    $mail->Body = "
        <p>Hola <strong>{$ticket['nombre']}</strong>,</p>
        <p>Tu ticket ha cambiado de estado.</p>
        <p><strong>Nuevo estado:</strong> $estado</p>
        <p><strong>Problema:</strong> {$ticket['problema']}</p>
        <br>
        <p>Soporte Técnico</p>
    ";

    $mail->send();
} catch (Exception $e) {
    // ❗ Si el correo falla, NO pasa nada
}

/* =========================
   VOLVER A LA LISTA
========================= */

header("Location: lista.php");
exit;
