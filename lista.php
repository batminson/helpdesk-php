<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <a href="logout.php" style="color:white">Salir</a>
    <h1>🎫 Helpdesk – Panel de Tickets</h1>
    <span>Administrador</span>
</header>
    
<?php session_start(); ?>

<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM tickets ORDER BY id DESC");

echo "<div class='container'>";
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

$esAdmin = isset($_SESSION['admin']);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // tu código actual
}

    echo "<tr>";
    echo "<td>TCK-{$row['id']}</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td class='problema'>{$row['problema']}</td>";
    $estado = $row['estado'];
$claseEstado = match ($estado) {
    'Pendiente' => 'badge pendiente',
    'En proceso' => 'badge proceso',
    'Cerrado' => 'badge cerrado',
    default => 'badge'
};

echo "<td><span class='$claseEstado'>$estado</span></td>";
    if ($esAdmin) {
    echo "<td class='acciones'>
        <a class='btn pendiente' href='cambiar_estado.php?id={$row['id']}&estado=Pendiente'>🟡 Pendiente</a>
        <a class='btn proceso' href='cambiar_estado.php?id={$row['id']}&estado=En proceso'>🔵 En proceso</a>
        <a class='btn cerrado' href='cambiar_estado.php?id={$row['id']}&estado=Cerrado'>🟢 Cerrado</a>
    </td>";
} else {
    echo "<td><em>Solo admin</em></td>";
}
    echo "</tr>";
}

echo "</table>";
echo "</div>";
?>

</body>
</html>










