<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Ticket de Soporte</title>
</head>
<body>

<h2>Formulario de Soporte Técnico</h2>

<form action="resultado.php" method="post">
    <label>Nombre y Apellido:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Problema:</label><br>
    <textarea name="problema" required></textarea><br><br>

    <button type="submit">Enviar Ticket</button>
</form>

</body>

</html>
