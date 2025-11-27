<?php
    include_once "conexion.php";
    session_start();

    $mensaje = "";

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadir_al_carrito'])) {
        
        if (!isset($_SESSION['id_usuario'])) {
            $mensaje = "<p class='error'>Debes <a href='login.php'>iniciar sesión</a> o <a href='alta.php'>registrarte</a> para poder añadir productos al carrito.</p>";
        
        } else {
            // Defino las variables
            $id_usuario = (int)$_SESSION['id_usuario'];
            $id_producto = (int)$_POST['id_producto'];
            

            $venta = "INSERT INTO ventas (id_usuario, id_producto) VALUES (?, ?)";
                
            if ($consulta = $mysqli->prepare($venta)) {
                
                // Vinculamos los valores a la consulta junto con su tipo
                $consulta->bind_param("ii", $id_usuario, $id_producto);
                    
                if ($consulta->execute()) {
                    $mensaje = "<p>Producto añadido a tus compras</p>";
                } else {
                    $mensaje = "<p>Error al registrar la venta: " . $consulta->error . "</p>";
                }
                $consulta->close();
            
            } else {
                $mensaje = "<p>Error al preparar la consulta: " . $mysqli->error . "</p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accesorios - Tienda Oficial CD Rioseco</title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    
    <body>
        <?php include_once 'navbar.php'; ?>
        <section class="categorias">
            <div class="container">
                <h2>Accesorios</h2>
            
                <div class="productos-grid">
                
                    <div class="categoria-card">
                        <img src="imagenes/mochila_espalda.png" class="categoria-imagen">
                        <h3>Mochila de espalda</h3>
                        
                        <form method="post" action="accesorios.php" class="personalizacion-form">
                            
                            <input type="hidden" name="id_producto" value="106"> 
                            
                            <button type="submit" name="añadir_al_carrito" class="btn-agregar-carrito">Comprar</button>
                        </form>
                    </div>

                    <div class="categoria-card">
                        <img src="imagenes/mochila_bandolera.png" class="categoria-imagen">
                        <h3>Mochila tipo bandolera</h3>
                        
                        <form method="post" action="accesorios.php" class="personalizacion-form">
                            
                            <input type="hidden" name="id_producto" value="107"> 
                            
                            <button type="submit" name="añadir_al_carrito" class="btn-agregar-carrito">Comprar</button>
                        </form>
                    </div>

                    <div class="categoria-card">
                        <img src="imagenes/guardabotas.png" class="categoria-imagen">
                        <h3>Guardabotas</h3>
                        
                        <form method="post" action="accesorios.php" class="personalizacion-form">
                            
                            <input type="hidden" name="id_producto" value="108"> 
                            
                            <button type="submit" name="añadir_al_carrito" class="btn-agregar-carrito">Comprar</button>
                        </form>
                    </div>
                
                </div>

            <?php echo $mensaje; ?>

        </div>
    </section>
</body>
</html>