<?php
    // Incluyo conexión.php al archivo
    include_once "conexion.php";
    session_start();

    // Variable para mensajes de error o éxito
    $mensaje = "";

    // Compruebo si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Compruebo que el email y la contraseña no estén vacíos
        if (isset($_POST['email']) && isset($_POST['contraseña'])) {
            $email = $mysqli->real_escape_string($_POST['email']);
            $contraseña = $mysqli->real_escape_string($_POST['contraseña']);
        
            // Compruebo las credenciales del usuario
            $select = "SELECT id_usuario, email, contrasena FROM usuarios WHERE email = '$email'";
            $sesion = $mysqli->query($select);

            // Compruebo si el usuario existe
            if ($sesion && $fila = $sesion->fetch_assoc()) {
                $contraseña_cifrada = $fila['contrasena'];
          
                // Comparo la contraseña
                if (password_verify($contraseña, $contraseña_cifrada)) {
                    $_SESSION['id_usuario'] = $fila['id_usuario'];

                    header("Location: inicio.php");
                    exit();
                } else {
                    $mensaje = "La contraseña es incorrecta.";
                }
            } else {
                $mensaje = "El usuario no existe.";
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
        <link rel="stylesheet" href="estilos.css">
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
            </form>

            <?php echo $mensaje; ?>
        </div>
    </body>
</html>