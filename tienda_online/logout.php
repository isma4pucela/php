<?php
    // Inicio la sesión
    session_start();

    // Verifico que el usuario esté logueado
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: inicio.php");
        exit();
    }

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
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    
    <body>
        <?php include_once 'navbar.php'; ?>

        <div class="registro-container">
            <h1>Cerrar Sesión</h1>
        
            <h2>¿Estás seguro de que quieres cerrar tu sesión?</h2>
            <p>Serás redirigido a la página de inicio.</p>

            <form method="post" action="logout.php">
                <input type="hidden" name="confirmar_logout" value="si"> 
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">CERRAR SESIÓN</button>
            </form>
        </div>
    </body>
</html>