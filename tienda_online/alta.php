<?php  
session_start();
include_once "conexion.php";

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$mensaje = '';

if ($email && $password && $nombre) {
    $check = $mysqli->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $resultado = $check->get_result();

    if ($resultado->num_rows > 0) {
        $mensaje = "El usuario ya existe.";
    } else {
        $query = $mysqli->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nombre, $email, $password);
        $query->execute();
        $mensaje = "Registro completado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Tienda Oficial CD Rioseco</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="registro-container">
        <h1>Registrarse</h1>

        <?php if ($mensaje != '') echo "<p class='mensaje'>$mensaje</p>"; ?>

        <form method="post" action="alta.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>

        <p class="login-link"><a href="inicio.php">Volver al inicio</a></p>
    </div>
</body>
</html>
