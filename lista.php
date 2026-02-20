<?php
// 🔐 Protección por login
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// 🔗 Conexión a la BD
require 'conexion.php';

// 📥 Obtener tickets
$resultado = $conn->query("SELECT * FROM tickets ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" href="estilos.css">
    <meta charset="UTF-8">
    <title>Lista de Tickets</title>
</head>
<body>

<h2>📋 Tickets de Soporte</h2>

<a class="logout" href="logout.php">Cerrar sesión</a>
<br><br>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Problema</th>
        <th>Estado</th>
        <th>Acción</th>
    </tr>

<?php
while ($row = $resultado->fetch_assoc()) {

    // ID bonito
    $ticketID = 'TCK-' . str_pad($row['id'], 3, '0', STR_PAD_LEFT);

    // Color por estado
    $estado = $row['estado'];
    $color = match ($estado) {
        'Pendiente'  => '#f1c40f',
        'En proceso' => '#3498db',
        'Finalizado' => '#2ecc71',
        default      => '#bdc3c7',
    };

    echo "<tr>";
    echo "<td>$ticketID</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['problema']}</td>";
    echo "<td style='background:$color; font-weight:bold; text-align:center;'>$estado</td>";
    echo "<td>
        <a href='cambiar_estado.php?id={$row['id']}&estado=En proceso'>En proceso</a> |
        <a href='cambiar_estado.php?id={$row['id']}&estado=Finalizado'>Finalizar</a>
    </td>";
    echo "</tr>";
}
$conn->close();
?>

</table>

</body>
</html>