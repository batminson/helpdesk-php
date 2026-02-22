<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

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

header("Location: lista.php");
exit;
