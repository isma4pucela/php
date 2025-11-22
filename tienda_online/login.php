<?php  
    include_once "conexion.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Aquí iría la lógica de autenticación
        // $resultado = $mysqli->query("SELECT * FROM usuarios WHERE email='$email' AND password='$password'");
        
        $mysqli->close(); 
    }
    else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tienda Oficial CD Rioseco</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="login-page">
    <?php include 'navbar.php'; ?>
    
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

            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>

        <p class="login-link">¿No tienes cuenta? <a href="alta.php">Regístrate aquí</a></p>
        <p class="login-link"><a href="inicio.php">Volver al inicio</a></p>
    </div>
</body>
</html>
<?php
    }
?>