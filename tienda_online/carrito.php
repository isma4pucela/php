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

    // Compruebo si se ha enviado el formulario de eliminar
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_compra'])) {
        
        $id_venta = $_POST['id_venta'];

        // Consulta para eliminar la compra
        $borrar = "DELETE FROM ventas WHERE id_venta = $id_venta AND id_usuario = $id_usuario";
        
        if ($mysqli->query($borrar) === TRUE) {  
            $mensaje = "<p>Artículo eliminado</p>";
        } else {
            $mensaje = "<p>Error al eliminar la compra: " . $mysqli->error . "</p>";
        }
    }
         
    // Compruebo si se ha enviado el formulario de comprar
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_compra'])) {
        
        $id_venta = $_POST['id_venta'];

        // Sentencia para actualizar el estado a "comprado"
        $confirmar_compra = "UPDATE ventas SET estado = 'comprado' WHERE id_venta = $id_venta AND id_usuario = $id_usuario";
        
        if ($mysqli->query($confirmar_compra) === TRUE) {
            $mensaje = "<p>Compra realizada con éxito</p>";
        } else {
            $mensaje = "<p>Error al procesar la compra: " . $mysqli->error . "</p>";
        }
    }

    // Compruebo si se ha enviado el formulario de vaciar carrito
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vaciar_carrito'])) {
        
        $vaciar_carrito = "DELETE FROM ventas WHERE id_usuario = $id_usuario AND (estado != 'comprado' OR estado IS NULL)";
        
        if ($mysqli->query($vaciar_carrito) === TRUE) {
            $mensaje = "<p>Carrito vaciado.</p>";
        } else {
            $mensaje = "<p>Error al vaciar el carrito: " . $mysqli->error . "</p>";
        }
    }

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comprar_carrito'])) {
        
        $comprar_carrito = "UPDATE ventas SET estado = 'comprado' WHERE id_usuario = $id_usuario AND (estado != 'comprado' OR estado IS NULL)";
        
        if ($mysqli->query($comprar_carrito) === TRUE) {
            $mensaje = "<p>Compra realizada con éxito</p>";
        } else {
            $mensaje = "<p>Error al procesar la compra: " . $mysqli->error . "</p>";
        }
    }

    // Consulta para obtener las compras del usuario junto con el nombre del producto
    $select = "SELECT v.id_venta, p.nombre as producto
               FROM ventas v 
               JOIN productos p ON v.id_producto = p.id_producto 
               WHERE v.id_usuario = $id_usuario
               AND (v.estado != 'comprado' OR v.estado IS NULL)";


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
                                    <td style="width: 80%"><?php echo $compra['producto']; ?></td>
                                    <td style="width: 10%;">
                                        <form method="post" action="carrito.php" style="border: none !important; padding: 0 !important; margin: 0 !important; box-shadow: none !important; background: none !important; display: inline;">
                                            <input type="hidden" name="id_venta" value="<?php echo $compra['id_venta']; ?>">
                                            <button type="submit" name="eliminar_compra" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                    <td style="width: 10%;">
                                        <form method="post" action="carrito.php" style="border: none !important; padding: 0 !important; margin: 0 !important; box-shadow: none !important; background: none !important; display: inline;">
                                            <input type="hidden" name="id_venta" value="<?php echo $compra['id_venta']; ?>">
                                            <button type="submit" name="confirmar_compra" class="btn btn-compra">Comprar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <table class="compras-table">
                        <tbody>
                                <tr>
                                    <td style="text-align: center;">
                                        <form method="post" action="carrito.php" style="border: none !important; padding: 0 !important; margin: 0 !important; box-shadow: none !important; background: none !important; display: inline;">
                                            <input type="hidden" name="id_venta" value="<?php echo $compra['id_venta']; ?>">
                                            <button type="submit" name="vaciar_carrito" class="btn btn-danger">Vaciar carrito</button>
                                        </form>
                                    </td>
                                    <td style="text-align: center;">
                                        <form method="post" action="carrito.php" style="border: none !important; padding: 0 !important; margin: 0 !important; box-shadow: none !important; background: none !important; display: inline;">
                                            <input type="hidden" name="id_venta" value="<?php echo $compra['id_venta']; ?>">
                                            <button type="submit" name="comprar_carrito" class="btn btn-compra">Comprar carrito</button>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <br><?php echo $mensaje; ?> 

            </div>
        </section>
    </body>
</html>