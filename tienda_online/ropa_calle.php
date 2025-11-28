<?php
    include_once "conexion.php";
    session_start();

    $mensaje = "";
    $tallas_disponibles = ['S', 'M', 'L', 'XL', 'XXL'];

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadir_al_carrito'])) {
        
        if (!isset($_SESSION['id_usuario'])) {
            $mensaje = "<p>Debes <a href='login.php'>iniciar sesión</a> o <a href='alta.php'>registrarte</a> para poder añadir productos al carrito.</p>";
        
        } else {
            // Defino las variables
            $id_usuario = (int)$_SESSION['id_usuario'];
            $id_producto = (int)$_POST['id_producto'];
            
            $talla_seleccionada = $_POST['talla'];

            if (!in_array($talla_seleccionada, $tallas_disponibles)) {
                $mensaje = "<p>Por favor, selecciona una talla válida.</p>";
            
            } else {
                
                // Consulta para insertar la venta (incluyendo los campos vacíos de personalización)
                $venta = "INSERT INTO ventas (id_usuario, id_producto, talla) VALUES (?, ?, ?)";
                    
                if ($consulta = $mysqli->prepare($venta)) {
                    
                    // Vinculamos los valores a la consulta junto con su tipo
                    $consulta->bind_param("iis", $id_usuario, $id_producto, $talla_seleccionada);
                        
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
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ropa de calle - Tienda Oficial CD Rioseco</title>
        <link rel="stylesheet" href="estilos.css">
    </head>

    <body>
        <?php include_once 'navbar.php'; ?>

        <section class="categorias">
            <div class="container">
                <h2>Ropa de calle</h2>
            
                <div class="productos-grid">
                
                    <div class="categoria-card">
                        <img src="imagenes/chandal.png" class="categoria-imagen">
                        <h3>Chándal</h3>
                    
                            <form method="post" action="ropa_calle.php" class="personalizacion-form">
                            
                                <input type="hidden" name="id_producto" value="103"> 
                            
                                <div class="form-group">
                                    <label for="talla">Talla:</label>
                                    <select id="talla" name="talla" required>
                                        <option value="">Selecciona</option>
                                        <?php foreach ($tallas_disponibles as $talla) { ?>
                                            <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            
                            
                                <button type="submit" name="añadir_al_carrito" class="btn-agregar-carrito">Comprar</button>
                        
                            </form>
                    
                    </div>

                    <div class="categoria-card">
                        <img src="imagenes/sudadera.png" class="categoria-imagen">
                        <h3>Sudadera</h3>
                    
                            <form method="post" action="ropa_calle.php" class="personalizacion-form">
                            
                                <input type="hidden" name="id_producto" value="104"> 
                            
                                <div class="form-group">
                                    <label for="talla">Talla:</label>
                                    <select id="talla" name="talla" required>
                                        <option value="">Selecciona</option>
                                        <?php foreach ($tallas_disponibles as $talla) { ?>
                                            <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                        <?php } ?>
                                        </select>
                                </div>
                            
                            
                                <button type="submit" name="añadir_al_carrito" class="btn-agregar-carrito">Comprar</button>
                        
                            </form>
                    
                    </div>

                    <div class="categoria-card">
                        <img src="imagenes/cazadora.png" class="categoria-imagen">
                        <h3>Cazadora</h3>
                    
                            <form method="post" action="ropa_calle.php" class="personalizacion-form">
                            
                                <input type="hidden" name="id_producto" value="105"> 
                            
                                <div class="form-group">
                                    <label for="talla">Talla:</label>
                                    <select id="talla" name="talla" required>
                                        <option value="">Selecciona</option>
                                        <?php foreach ($tallas_disponibles as $talla) { ?>
                                            <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            
                            
                                <button type="submit" name="añadir_al_carrito" class="btn-agregar-carrito">Comprar</button>
                        
                            </form>
                    
                    </div>
                </div>

                <?php echo $mensaje; ?>

            </div>
        </section>
    </body>
</html>