<?php
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';

    // Credenciales simples (luego se mejoran)
    if ($usuario === 'admin' && $clave === '1234') {
        $_SESSION['admin'] = true;
        header("Location: lista.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="max-width:400px">
    <h2>🔐 Login Administrador</h2>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="usuario" placeholder="Usuario" required><br><br>
        <input type="password" name="clave" placeholder="Contraseña" required><br><br>
        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>
