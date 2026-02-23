<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Ticket de Soporte</title>
</head>
<body>

<div class="container" style="max-width:500px">
    <h2>🎫 Crear Ticket de Soporte</h2>

    <form method="post" action="resultado.php">
        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Describe el problema</label>
        <textarea name="problema" rows="4" required></textarea>

        <button type="submit">Enviar Ticket</button>
    </form>
</div>

</body>

</html>


