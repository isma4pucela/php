<?php  
include_once "conexion.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email && $password) {
    $mysqli->query("INSERT INTO usuarios (email, password) VALUES ('$email','$password')");  
    echo "Ha sido dado de alta <br>";
    $mysqli->close(); 
    echo "Desconexión realizada.";
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
        <form method="post" action="alta.php">
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
