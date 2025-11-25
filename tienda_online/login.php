<?php  
session_start();
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($email && $password) {
        $query = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: inicio.php");
            exit();
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, completa todos los campos.";
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
    <?php include 'navbar.php'; ?>
    
    <div class="login-container">
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

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>

        <p class="login-link"><a href="alta.php">¿No tienes cuenta? Regístrate</a></p>
    </div>
</body>
</html>
