<?php
    include_once "conexion.php";
    session_start();

    $mensaje = "";
    
    // Verifico si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        // Redirijo al login si no ha iniciado sesión
        header('Location: login.php');
        exit;
    }

    $id_usuario = $_SESSION['id_usuario'];

    // Consulta para obtener las compras del usuario junto con el nombre del producto
    $select = "SELECT v.id_venta, p.nombre as producto
               FROM ventas v 
               JOIN productos p ON v.id_producto = p.id_producto 
               WHERE v.id_usuario = $id_usuario
               AND v.estado = 'comprado'";

    $compras = array();

     $resultado = $mysqli->query($select);

    if ($resultado) {  
        
        // Meto en el array asociativo compras el resultado de la consulta
        $compras = $resultado->fetch_all(MYSQLI_ASSOC);

    } else {
        $mensaje .= "<p>Error: " . $mysqli->error . "</p>";
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mis compras</title>
        <link rel="stylesheet" href="estilos.css">
    </head>

    <body>
        <?php include_once 'navbar.php'; ?>

        <section class="mis-compras">
            <div class="container">
                <h2>Mis compras</h2>
                                    
                    <table class="compras-table">
                    
                        <tbody>
                            <?php foreach ($compras as $compra) { ?>
                                <tr>
                                    <td><?php echo $compra['producto']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <br><?php echo $mensaje; ?> 

            </div>
        </section>
    </body>
</html>