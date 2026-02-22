<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: lista.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
<h2>Login de Administrador</h2>

<form action="procesar_login.php" method="post">
    <label>Usuario:</label><br>
    <input type="text" name="usuario" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ingresar</button>
</form>
</body>
</html>
