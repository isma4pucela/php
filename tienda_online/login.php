<?php
// Incluyo conexión.php al archivo
include_once "conexion.php";
session_start();

$mensaje = "";

// Compruebo si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Compruebo que el email y la contraseña no estén vacíos
    if (isset($_POST['email']) && isset($_POST['contraseña'])) {
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        
        // Compruebo las credenciales del usuario
        $sesion = $mysqli->query("SELECT id, email FROM usuarios WHERE email = '$email' AND contraseña = '$contraseña'");
        
        if ($sesion->num_rows > 0) {
            // Meto los datos del usuario en un array asociativo
            $usuario = $sesion->fetch_assoc();
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            
            $mensaje = "<p>Ha iniciado sesión con $email</p>";
            
        } else {
            $mensaje = "<p>Correo o contraseña incorrectos</p>";
        }
    } 
}

// Cierro la conexión a la base de datos
$mysqli->close();
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
                <input type="password" id="password" name="contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            
            <?php echo $mensaje; ?>
        </form>
    </div>
</body>
</html>