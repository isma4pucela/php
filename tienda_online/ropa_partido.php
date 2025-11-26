<?php //falta conectarlo a la bd
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
            $mensaje = "<p>Debes iniciar sesión para poder añadir productos al carrito.</p>";
        } else {
            $talla_seleccionada = $_POST['talla'];
            $dorsal_ingresado = $_POST['dorsal'];
            $nombre_ingresado = $_POST['nombre_personalizado'];
    
            // Validación de talla, dorsal y nombre
            if (!in_array($talla_seleccionada, $tallas_disponibles)) {
                $mensaje = "<p>Por favor, selecciona una talla</p>";

            } elseif (empty($dorsal_ingresado) && strlen($dorsal_ingresado) > $longitud_dorsal) {
                $mensaje = "<p>El dorsal debe ser numérico y tener máximo $longitud_dorsal dígitos.</p>";

            } elseif (strlen($nombre_ingresado) > $longitud_nombre) {
                $mensaje = "<p>El nombre no puede exceder los $longitud_nombre   caracteres.</p>";
        
            } else {
                $mensaje = "<p>Producto añadido al carrito</p>";
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
                        
                            <div class="form-group">
                                <label>Talla:</label>
                                <select id="talla" name="talla" required>
                                    <option value="">Selecciona</option>
                                    <?php foreach ($tallas_disponibles as $talla) { ?>
                                        <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dorsal:</label>
                                <input type="number" id="dorsal" name="dorsal" min="1" max="99">
                            </div>

                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" id="nombre_personalizado" name="nombre_personalizado" maxlength="<?php echo $longitud_nombre; ?>" >
                            </div>
                            <button type="submit" name="añadir_al_carrito" class="btn btn-primary">Añadir al carrito</button>

                        </form>
                    
                    </div>
                
                    <div class="categoria-card">
                        <img src="imagenes/equipacion2.png" class="categoria-imagen">
                        <h3>2ª Equipación</h3>

                        <form method="post" action="ropa_partido.php" class="personalizacion-form">
                        
                            <div class="form-group">
                                <label>Talla:</label>
                                <select id="talla" name="talla" required>
                                    <option value="">Selecciona</option>
                                    <?php foreach ($tallas_disponibles as $talla) { ?>
                                        <option value="<?php echo $talla; ?>"><?php echo $talla; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Dorsal:</label>
                                <input type="number" id="dorsal" name="dorsal" min="1" max="99">
                            </div>

                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" id="nombre_personalizado" name="nombre_personalizado" maxlength="<?php echo $longitud_nombre; ?>" >
                            </div>

                            <button type="submit" name="añadir_al_carrito" class="btn btn-primary">Añadir al carrito</button>

                        </form>
                    </div>
                </div>

                <br><?php echo $mensaje; ?> 

            </div>
        </section>
    </body>
</html>