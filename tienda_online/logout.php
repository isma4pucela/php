<?php
    // Inicio la sesión
    session_start();

    // Verifico que el usuario esté logueado
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: inicio.php");
        exit();
    }

    // Compruebo si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_logout'])) {
        // Vacío el array con los datos
        $_SESSION = array();

        //  Cierro la sesión
        session_destroy();

        // Redirijo al usuario a la página de inicio
        header("Location: inicio.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cerrar Sesión - Tienda Oficial CD Rioseco</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    
    <body>
        <?php include_once 'navbar.php'; ?>

        <div class="registro-container">
            <h1>Cerrar Sesión</h1>
        
            <form method="post" action="logout.php" style="border: 0px;">
                <input type="hidden" name="confirmar_logout" value="si"> 
                <button type="submit" class="btn btn-primary">CERRAR SESIÓN</button>
            </form>
        </div>
    </body>
</html>