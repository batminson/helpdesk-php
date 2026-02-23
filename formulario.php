<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-center">
    <div class="card">
        <h2>🎫 Crear Ticket de Soporte</h2>

        <form method="post" action="resultado.php">

            <div class="field">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="field">
                <label>Describe el problema</label>
                <textarea name="problema" rows="4" required></textarea>
            </div>

            <button type="submit">Enviar Ticket</button>

        </form>
    </div>
</div>

</body>
</html>


