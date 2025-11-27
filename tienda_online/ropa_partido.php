<?php
    include_once "conexion.php";
    session_start();

    $tallas_disponibles = array('S', 'M', 'L', 'XL', 'XXL');
    $longitud_dorsal = 2;
    $longitud_nombre = 25;
    $mensaje = "";

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadir_al_carrito'])) {
        
        // Verifico si el usuario ha iniciado sesión
        if (!isset($_SESSION['id_usuario'])) {
            $mensaje = "<p>Debes <a href='login.php'>iniciar sesión</a> o <a href='alta.php'>registrarte</a> para poder añadir productos al carrito.</p>";
            
        } else {
            // Defino las variables
            $id_usuario = (int)$_SESSION['id_usuario'];
            $id_producto_comprado = (int)$_POST['id_producto'];
            
            // Recoger los campos de personalización para validarlos (aunque no se guarden)
            $talla_seleccionada = $_POST['talla'];
            $dorsal_ingresado = $_POST['dorsal']; 
            $nombre_ingresado = $_POST['nombre_personalizado'];
    
            // VALIDACIÓN (Mantenemos la validación para que el formulario se use correctamente)
            if (!in_array($talla_seleccionada, $tallas_disponibles)) {
                $mensaje = "<p>Por favor, selecciona una talla válida.</p>";

            } elseif (!empty($dorsal_ingresado) && 
                      (!is_numeric($dorsal_ingresado) || strlen($dorsal_ingresado) > $longitud_dorsal) ) {
                $mensaje = "<p>El dorsal debe ser numérico y tener máximo $longitud_dorsal dígitos. También puedes dejarlo vacío.</p>";

            } elseif (strlen($nombre_ingresado) > $longitud_nombre) {
                $mensaje = "<p>El nombre no puede exceder los $longitud_nombre caracteres.</p>";
        
            } else {
                // Insertar la compra en la base de datos
                $query_venta = "INSERT INTO ventas (id_usuario, id_producto, talla, dorsal, nombre_personalizado) VALUES (?, ?, ?, ?, ?)";
                    
                if ($stmt = $mysqli->prepare($query_venta)) {
                        
                    // Vincula los valores a la consulta junto con su tipo
                    $stmt->bind_param("iisss", $id_usuario, $id_producto_comprado, $talla_seleccionada, $dorsal_ingresado, $nombre_ingresado);
                        
                    if ($stmt->execute()) {
                            $mensaje = "<p>¡Producto añadido a tus compras con éxito!</p>";
                    } else {
                            $mensaje = "<p>Error al registrar la venta: " . $stmt->error . "</p>";
                    }
                        
                    $stmt->close();

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
        <title>Ropa de Partido - Tienda Oficial CD Rioseco</title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>

    <body>
        <?php include_once 'navbar.php'; ?>

        <section class="categorias">
            <div class="container">
                <h2>Ropa de Partido</h2>
                
                        
                <div class="categorias-grid">
                
                    <div class="categoria-card">
                        <img src="imagenes/equipacion1.png" class="categoria-imagen">
                        <h3>1ª Equipación</h3>
                    
                        <form method="post" action="ropa_partido.php" class="personalizacion-form">
                            
                            <input type="hidden" name="id_producto" value="101"> 
                            
                            <div class="form-group">
                                <label for="talla">Talla:</label>
                                <select id="talla" name="talla" required>
                                    <option value="">Selecciona</option>
                                    <?php foreach ($tallas_disponibles as $talla) { ?>
                                        <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dorsal">Dorsal:</label>
                                <input type="number" id="dorsal" name="dorsal" min="1" max="99">
                            </div>

                            <div class="form-group">
                                <label for="nombre_personalizado">Nombre:</label>
                                <input type="text" id="nombre_personalizado" name="nombre_personalizado" maxlength="<?php echo $longitud_nombre; ?>" >
                            </div>
                            <button type="submit" name="añadir_al_carrito" class="btn btn-primary">Comprar</button>

                        </form>
                    
                    </div>
                
                    <div class="categoria-card">
                        <img src="imagenes/equipacion2.png" class="categoria-imagen">
                        <h3>2ª Equipación</h3>

                        <form method="post" action="ropa_partido.php" class="personalizacion-form">
                        
                            <input type="hidden" name="id_producto" value="102"> 
                            
                            <div class="form-group">
                                <label for="talla_2">Talla:</label>
                                <select id="talla_2" name="talla" required>
                                    <option value="">Selecciona</option>
                                    <?php foreach ($tallas_disponibles as $talla) { ?>
                                        <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dorsal_2">Dorsal:</label>
                                <input type="number" id="dorsal_2" name="dorsal" min="1" max="99">
                            </div>

                            <div class="form-group">
                                <label for="nombre_personalizado_2">Nombre:</label>
                                <input type="text" id="nombre_personalizado_2" name="nombre_personalizado" maxlength="<?php echo $longitud_nombre; ?>" >
                            </div>

                            <button type="submit" name="añadir_al_carrito" class="btn btn-primary">Comprar</button>

                        </form>
                    </div>
                </div>

                <br><?php echo $mensaje; ?> 

            </div>
        </section>
    </body>
</html>