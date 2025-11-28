<?php
    // Incluyo la conexión
    include_once "conexion.php";
    session_start();

    $mensaje = "";

    // Verifico si el usuario está logueado
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: login.php');
        exit;
    }

    $id_usuario = (int)$_SESSION['id_usuario'];
    $usuario_actual = "";

    // Obtengo el email del usuario actual
    $email = "SELECT email FROM usuarios WHERE id_usuario = ?";
    if ($consulta1 = $mysqli->prepare($email)) {
        $consulta1->bind_param("i", $id_usuario);
        $consulta1->execute();
        $resultado = $consulta1->get_result();
        if ($fila = $resultado->fetch_assoc()) {
            $usuario_actual = $fila['email'];
        }
        $consulta1->close();
    }
    
    // Proceso el formulario de cambio de contraseña
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cambiar_contraseña'])) {
        
        $contraseña_nueva = $_POST['contraseña_nueva'];

        if (empty($contraseña_nueva)) {
            $mensaje = "<p>Es obligatorio introducir una nueva contraseña.</p>";
        } else {
            // Cambio la contraseña
            $cambio = "UPDATE usuarios SET contraseña = ? WHERE id_usuario = ?";
            
            if ($consulta = $mysqli->prepare($cambio)) {
                
                $consulta->bind_param("si", $contraseña_nueva, $id_usuario);
                
                if ($consulta->execute()) {
                    $mensaje = "<p>Su contraseña se ha actualizado</p>";
                } else {
                    $mensaje = "<p>Error al actualizar la contraseña: " . $consulta->error . "</p>";
                }
                $consulta->close();
            } else {
                $mensaje = "<p>Error al preparar la consulta de actualización: " . $mysqli->error . "</p>";
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
        <title>Mi Cuenta - Perfil</title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>

    <body>
        <?php include_once 'navbar.php'; ?>

        <div class="registro-container"> <h1>Mi Cuenta</h1>
            <h3><?php echo $usuario_actual; ?></h3>
                        
            <form method="post" action="mi_cuenta.php">
                <h2>Cambiar Contraseña</h2>
                
                <div class="form-group">
                    <label for="contraseña_nueva">Nueva Contraseña:</label>
                    <input type="password" id="contraseña_nueva" name="contraseña_nueva" required>
                </div>
                              
                <button type="submit" name="cambiar_contraseña" class="btn btn-primary">Actualizar Contraseña</button>
            </form>
            
            <?php echo $mensaje; ?> 

        </div>
    </body>
</html>