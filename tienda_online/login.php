<?php
// Incluyo conexión.php al archivo
include_once "conexion.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $resultado = $mysqli->query("SELECT * FROM usuarios WHERE email='$email' AND password='$password'");
    if ($resultado->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: inicio.php");
        exit();
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tienda Oficial CD Rioseco</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="registro-container">
        <h1>Iniciar Sesión</h1>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>
