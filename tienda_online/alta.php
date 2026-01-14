<?php
    // Incluyo el archivo conexión.php
    include_once "conexion.php";

    // Inicio la sesión
    session_start();

    // Variable para mensajes de error o éxito
    $mensaje = "";
    
    // Compruebo si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Compruebo que el email y la contraseña no estén vacíos
        if (isset($_POST['email']) && isset($_POST['contraseña'])) {
            $email = $mysqli->real_escape_string($_POST['email']);
            $contraseña = $mysqli->real_escape_string($_POST['contraseña']);
            $confirmar_contraseña = $mysqli->real_escape_string($_POST['confirmar_contraseña']);

            if ($confirmar_contraseña !== $contraseña) {
                $mensaje = "Las contraseñas no coinciden";
            } else {
                // Cifro la contraseña
                $contraseña_cifrada = password_hash($contraseña, PASSWORD_DEFAULT);
        
                // Compruebo si el email ya está registrado
                $registrado = $mysqli->query("SELECT email FROM usuarios WHERE email = '$email'");
            
                // Si el email ya existe, muestro un mensaje de error
                if ($registrado->num_rows > 0) {
                    $mensaje = "<p>$email ya está registrado</p>";
                } else {
                
                    $cuenta = $mysqli->query("INSERT INTO usuarios (email, contrasena) VALUES ('$email', '$contraseña_cifrada')");

                    if ($cuenta === TRUE) {
                    
                        // Obtengo el ID del nuevo usuario
                        $id_nuevo_usuario = $mysqli->insert_id;

                        // Inicio la sesión con el nuevo ID y el email
                        $_SESSION['id_usuario'] = $id_nuevo_usuario;
                        $_SESSION['email'] = $email;
                    
                        // Redirijo al usuario a la página de inicio
                        header("Location: inicio.php");
                        exit();
                    
                    } else {
                        $mensaje = "<p>Error al registrar el usuario: " . $mysqli->error . "</p>";
                    }
                }
            }
        }
    
    }
            
    // Cerramos la conexión a la base de datos
    $mysqli->close();
?>

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alta - Tienda Oficial CD Rioseco</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    
    <body>
        <?php include_once 'navbar.php'; ?>
    
        <div class="registro-container">
            <h1>Registrarse</h1>

            <form method="post" action="alta.php">
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="contraseña" required>
                </div>

                <div class="form-group">
                    <label for="password">Confirmar contraseña:</label>
                    <input type="password" id="password" name="confirmar_contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            
            <?php echo $mensaje; ?>
        </div>
    </body>
</html>