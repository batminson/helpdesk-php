<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
    <h1>🎫 Helpdesk – Panel de Tickets</h1>
    <span>Administrador</span>
</header>

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
    $estado = $row['estado'];
$claseEstado = match ($estado) {
    'Pendiente' => 'badge pendiente',
    'En proceso' => 'badge proceso',
    'Cerrado' => 'badge cerrado',
    default => 'badge'
};

echo "<td><span class='$claseEstado'>$estado</span></td>";
    echo "<td class='acciones'>
        <a class='btn pendiente' href='cambiar_estado.php?id={$row['id']}&estado=Pendiente'>🟡 Pendiente</a>
        <a class='btn proceso' href='cambiar_estado.php?id={$row['id']}&estado=En proceso'>🔵 En proceso</a>
        <a class='btn cerrado' href='cambiar_estado.php?id={$row['id']}&estado=Cerrado'>🟢 Cerrado</a>
    </td>";
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>





