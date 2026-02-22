<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

/* =========================
   VALIDAR DATOS
========================= */
if (!isset($_GET['id'], $_GET['estado'])) {
    header("Location: lista.php");
    exit;
}

$id = (int) $_GET['id'];
$estado = $_GET['estado'];

/* =========================
   ACTUALIZAR ESTADO
========================= */
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
   PHPMailer + BREVO
========================= */
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'a30374001@smtp-brevo.com';   // 👈 de Brevo
    $mail->Password = 'bskyYnVFz9CVirx';     // 👈 de Brevo
    $mail->Port = 587;
    $mail->SMTPDebug = 0; // 🔑 clave para Railway

    $mail->setFrom('soporte@helpdesk.com', 'Soporte Helpdesk');
    $mail->addAddress($ticket['email'], $ticket['nombre']);

    $mail->isHTML(true);
    $mail->Subject = "Actualización de tu ticket TCK-$id";
    $mail->Body = "
        <p>Hola <strong>{$ticket['nombre']}</strong>,</p>
        <p>Tu ticket ha cambiado de estado.</p>
        <p><strong>Nuevo estado:</strong> <b>$estado</b></p>
        <p><strong>Problema:</strong> {$ticket['problema']}</p>
        <br>
        <p>Soporte Técnico</p>
    ";

    $mail->send();

} catch (Exception $e) {
    // Si el correo falla, NO se cae la app
}

/* =========================
   VOLVER A LISTA
========================= */
header("Location: lista.php");
exit;
