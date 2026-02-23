<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

$result = $db->query("SELECT * FROM tickets ORDER BY id DESC");

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>
    
echo "<h2>Lista de Tickets</h2>";
echo "<table border='1' cellpadding='5'>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Email</th>
<th>Problema</th>
<th>Estado</th>
<th>Acciones</th>
</tr>";

while ($row = $result->fetchArray()) {
    echo "<tr>";
    echo "<td>TCK-" . $row['id'] . "</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['problema']}</td>";
    echo "<td>{$row['estado']}</td>";
    echo "<td>
        <a href='cambiar_estado.php?id={$row['id']}&estado=Pendiente'>🟡 Pendiente</a> |
        <a href='cambiar_estado.php?id={$row['id']}&estado=En_proceso'>🔵 En proceso</a> |
        <a href='cambiar_estado.php?id={$row['id']}&estado=Cerrado'>🟢 Cerrado</a>
    </td>";
    echo "</tr>";
}

echo "</table>";





