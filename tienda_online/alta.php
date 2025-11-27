<?php
    // Incluyo el archivo conexión.php
    include_once "conexion.php";

    // Inicio la sesión
    session_start();

    $mensaje = "";
    
    // Compruebo si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Compruebo que el email y la contraseña no estén vacíos
        if (isset($_POST['email']) && isset($_POST['contraseña'])) {
            $email = $_POST['email'];
            $contraseña = $_POST['contraseña'];
        
            // Compruebo si el email ya está registrado
            $registrado = $mysqli->query("SELECT email FROM usuarios WHERE email = '$email'");
            
            if ($registrado->num_rows > 0) {
                $mensaje = "<p class='error'>$email ya está registrado</p>";
            } else {
                
                $insert_id = $mysqli->query("INSERT INTO usuarios (email, contraseña) VALUES ('$email', '$contraseña')");

                if ($insert_id === TRUE) {
                    
                    // Obtengo el ID del nuevo usuario
                    $id_nuevo_usuario = $mysqli->insert_id;

                    // Inicio la sesión con el nuevo ID y el email
                    $_SESSION['id_usuario'] = $id_nuevo_usuario;
                    $_SESSION['email'] = $email;
                    
                    header("Location: inicio.php");
                    exit();
                    
                } else {
                    $mensaje = "<p class='error'>Error al registrar el usuario: " . $mysqli->error . "</p>";
                }
            }
        } else {
             $mensaje = "<p class='error'>Por favor, introduce el correo y la contraseña.</p>";
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
        <link rel="stylesheet" href="css/estilos.css">
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

                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            
            <?php echo $mensaje; ?>
        </div>
    </body>
</html>