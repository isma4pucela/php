<?php
    // Incluyo conexión.php
    include_once "conexion.php";
    
    // Inicio la sesión
    session_start();

    $mensaje = "";

    // Verifico que el usuario esté logueado
    if (isset($_SESSION['id_usuario'])) { 
            $id_usuario = $_SESSION['id_usuario'];
    } else {
        header("Location: login.php");
        exit();
    }

    // Compruebo si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_baja'])) {
    
        // Elimino al usuario
        $baja = $mysqli->query("DELETE FROM usuarios WHERE id = '$id_usuario'");
    
        if ($baja === TRUE) {
            session_destroy();  
        } else {
            $mensaje = "<p>Error al eliminar la cuenta: " . $mysqli->error . "</p>";
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
    <title>Eliminar Cuenta - Tienda Oficial CD Rioseco</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="registro-container">
        <h1>Eliminar Cuenta</h1>
        
        <?php echo $mensaje; ?>          
            <p>Esta acción es irreversible y se perderán todos tus datos. No podrás iniciar sesión de nuevo con este correo.</p>

            <form method="post" action="baja.php">
                <button type="submit" class="btn btn-primary" style="background-color: var(--error); margin-top: 20px;">ELIMINAR CUENTA</button>
            </form>
    </div>
</body>
</html>