<?php
require 'db.php';

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = (int) $_GET['id'];
    $estado = $_GET['estado'];

    $stmt = $db->prepare("UPDATE tickets SET estado = :estado WHERE id = :id");
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

header("Location: lista.php");
exit;
