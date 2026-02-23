<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require 'db.php';

$result = $db->query("SELECT * FROM tickets ORDER BY id DESC");

echo "<h2>Lista de Tickets</h2>";

echo "<table>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Email</th>
<th>Problema</th>
<th>Estado</th>
<th>Acciones</th>
</tr>";

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

    echo "<tr>";
    echo "<td>TCK-{$row['id']}</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['problema']}</td>";
    echo "<td>{$row['estado']}</td>";
    echo "<td>
        <a href='cambiar_estado.php?id={$row['id']}&estado=Pendiente'>🟡 Pendiente</a><br>
        <a href='cambiar_estado.php?id={$row['id']}&estado=En proceso'>🔵 En proceso</a><br>
        <a href='cambiar_estado.php?id={$row['id']}&estado=Cerrado'>🟢 Cerrado</a>
    </td>";
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>

