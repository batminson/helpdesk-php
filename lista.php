<?php
require 'db.php';

$result = $db->query("SELECT * FROM tickets ORDER BY id DESC");

echo "<h2>Lista de Tickets</h2>";
echo "<table border='1' cellpadding='5'>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Email</th>
<th>Problema</th>
<th>Estado</th>
</tr>";

while ($row = $result->fetchArray()) {
    echo "<tr>";
    echo "<td>TCK-" . $row['id'] . "</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['problema']}</td>";
    echo "<td>{$row['estado']}</td>";
    echo "</tr>";
}

echo "</table>";
