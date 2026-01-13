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

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_compra'])) {
        
        $id_venta = $_POST['id_venta'];

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
    $select = "SELECT v.id_venta, p.nombre as producto
                     FROM ventas v 
                     JOIN productos p ON v.id_producto = p.id_producto 
                     WHERE v.id_usuario = ?";
    
    $compras = array();
    
    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_compra'])) {
        
        $id_venta = $_POST['id_venta'];

        // Sentencia para actualizar el estado a "comprado"
        $actualizar = "UPDATE ventas SET estado = 'comprado' WHERE id_venta = ? AND id_usuario = ?";
        
        if ($consulta = $mysqli->prepare($actualizar)) {
            
            // Vincula los valores (id_venta y id_usuario son enteros)
            $consulta->bind_param("ii", $id_venta, $id_usuario);
            
            if ($consulta->execute()) {
                $mensaje = "<p>Compra realizada con éxito</p>";
            } else {
                $mensaje = "<p>Error al procesar la compra: " . $consulta->error . "</p>";
            }
            $consulta->close();
            
        } else {
            $mensaje = "<p>Error en la consulta: " . $mysqli->error . "</p>";
        }
    }

    if ($consulta = $mysqli->prepare($select)) {
        
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
        <title>Mi carrito</title>
        <link rel="stylesheet" href="estilos.css">
    </head>

    <body>
        <?php include_once 'navbar.php'; ?>

        <section class="mis-compras">
            <div class="container">
                <h2>Mi carrito</h2>
                                    
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