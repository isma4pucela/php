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

    $id_usuario = (int)$_SESSION['id_usuario'];

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_compra'])) {
        
        $id_venta = (int)$_POST['id_venta'];

        // Consulta para eliminar la compra
        $borrar = "DELETE FROM ventas WHERE id_venta = ? AND id_usuario = ?";
        
        if ($consulta = $mysqli->prepare($borrar)) {
            
            // Vincula los valores a la consulta
            $consulta->bind_param("ii", $id_venta, $id_usuario);
            
            if ($consulta->execute()) {
                $mensaje = "<p>Artículo eliminado</p>";
            } else {
                $mensaje = "<p>Error al eliminar la compra: " . $consulta->error . "</p>";
        }
        $consulta->close();
        
        } else {
            $mensaje = "<p>Error: " . $mysqli->error . "</p>";
        }
    }
    
    // Consulta para obtener las compras del usuario junto con el nombre del producto
    $query_select = "SELECT v.id_venta, p.nombre as producto, v.talla, v.dorsal, v.nombre 
                     FROM ventas v 
                     JOIN productos p ON v.id_producto = p.id_producto 
                     WHERE v.id_usuario = ?";
    
    $compras = array();
    
    if ($consulta = $mysqli->prepare($query_select)) {
        
        // Vinculo el parámetro
        $consulta->bind_param("i", $id_usuario);
        $consulta->execute();
        
        // Obtengo el resultado
        $resultado = $consulta->get_result();
        
        // Meto en el array asociativo compras el resultado de la consulta
        $compras = $resultado->fetch_all(MYSQLI_ASSOC);

        $consulta->close();
        
    } else {
        $mensaje .= "<p>Error: " . $mysqli->error . "</p>";
    }
    
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mis Compras</title>
        <link rel="stylesheet" href="estilos.css">
    </head>

    <body>
        <?php include_once 'navbar.php'; ?>

        <section class="mis-compras">
            <div class="container">
                <h2>Mis compras</h2>
                                    
                    <table class="compras-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Dorsal</th>
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($compras as $compra) { ?>
                                <tr>
                                    <td><?php echo $compra['producto']; ?></td>
                                    <td><?php echo $compra['talla']; ?></td>
                                    <td><?php echo $compra['dorsal']; ?></td>
                                    <td><?php echo $compra['nombre']; ?></td>
                                    <td>
                                        <form method="post" action="mis_compras.php" style="border: none !important; padding: 0 !important; margin: 0 !important; box-shadow: none !important; background: none !important; display: inline;">
                                            <input type="hidden" name="id_venta" value="<?php echo htmlspecialchars($compra['id_venta']); ?>">
                                            <button type="submit" name="eliminar_compra" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <br><?php echo $mensaje; ?> 

            </div>
        </section>
    </body>
</html>