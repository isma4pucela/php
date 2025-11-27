<?php
    include_once "conexion.php";
    session_start();

    // Definiciones
    $tallas_disponibles = array('S', 'M', 'L', 'XL', 'XXL');
    $longitud_dorsal = 2;
    $longitud_nombre = 25;
    $mensaje = "";

    // Compruebo si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadir_al_carrito'])) {
        
        // 1. Verifico si el usuario ha iniciado sesión
        if (!isset($_SESSION['id_usuario'])) {
            $mensaje = "<p>Debes iniciar sesión.</p>";
            
        } else {
            // Defino las variables
            $id_usuario = (int)$_SESSION['id_usuario'];
            $id_producto_comprado = (int)$_POST['id_producto'];

            $query_venta = "INSERT INTO ventas (id_usuario, id_producto) VALUES (?, ?)";
                
            if ($stmt = $mysqli->prepare($query_venta)) {
                    
                    
                if ($stmt->execute()) {
                        $mensaje = "<p>Producto comprado con éxito.</p>";
                } else {
                        $mensaje = "<p>Error al registrar la venta: " . $stmt->error . "</p>";
                }
                    
                $stmt->close();

            } else {
                $mensaje = "<p>Error: " . $mysqli->error . "</p>";
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
                
                <br><?php echo $mensaje; ?> 
                        
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
            </div>
        </section>
    </body>
</html>