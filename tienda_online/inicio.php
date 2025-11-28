<?php
    // Incluyo la conexión
    include_once "conexion.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // Compruebo que la conexión se haya realizado correctamente
    if (!isset($mysqli) || $mysqli->connect_error) {
        die("Error FATAL: No se pudo establecer la conexión con la base de datos. Por favor, revise 'conexion.php'.");
    }

    $mensaje = ""; 
    $productos = []; 
    $listado = ""; 
    $busqueda = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadir_al_carrito'])) {
        
        if (!isset($_SESSION['id_usuario'])) {
            $mensaje = "<p>Debes iniciar sesión para poder comprar.</p>";
        } else {
            // Usuario está logueado, procesamos la compra
            $id_usuario = (int)$_SESSION['id_usuario'];
            $id_producto = (int)$_POST['id_producto'];

            $venta = "INSERT INTO ventas (id_usuario, id_producto) VALUES (?, ?)";
                
            if ($consulta1 = $mysqli->prepare($venta)) {
                	
                    //Vinculo los datos
                    $consulta1->bind_param("ii", $id_usuario, $id_producto);
                
                if ($consulta1->execute()) {
                    $mensaje = "<p>Producto añadido al carrito con éxito.</p>";
                } else {
                    $mensaje = "<p>Error al registrar la venta: " . $consulta1->error . "</p>";
                }
                $consulta1->close();
            } else {
                $mensaje = "<p>Error al preparar la consulta de venta: " . $mysqli->error . "</p>";
            }
        }
    }


    
    // Verificamos si se envió el formulario de búsqueda (POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar']) && $_POST['buscar'] !== "") {
        $busqueda = $_POST['buscar'];
    }

    $buscar = '%' . $busqueda . '%';
    
    $insertar = "SELECT id_producto, nombre FROM productos"; 
            
    $tipos = ""; 
    $parametros = [];

    // Si hay un término de búsqueda, añadimos el filtro WHERE (seguro)
    if (!empty($busqueda)) {
        $insertar .= " WHERE nombre LIKE ?";
        $tipos = "s"; // Solo un string
        $parametros = [&$buscar];
    }
    
    // Ejecución de la consulta preparada
    if ($consulta2 = $mysqli->prepare($insertar)) {
        
        if (!empty($tipos)) {
            $consulta2->bind_param($tipos, ...$parametros); 
        }

        $consulta2->execute();
        $resultado = $consulta2->get_result();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $productos[] = $fila;
            }
        } else {
            if (!empty($busqueda)) {
                 $listado = "No se encontraron productos que coincidan con: '<strong>" . htmlspecialchars($busqueda) . "</strong>'.";
            } else {
                 $listado = "No hay productos en la tienda.";
            }
        }
        $consulta2->close();
    } else {
        $listado = "Error al preparar la consulta de listado: " . $mysqli->error;
    }

    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Inicio - Tienda Oficial CD Rioseco</title>
    	<link rel="stylesheet" href="estilos.css">
	</head>
	
    <body>
    
    	<?php include_once 'navbar.php'; ?>

    	<section class="banner">
        	<div class="container">
            	<h1>Bienvenido a la Tienda Oficial CD Rioseco</h1>
        	</div>
    	</section>

    <div class="container" style="padding-top: 3rem;">
        
        <h2>Productos</h2>
        
        
        <form action="inicio.php" method="POST" class="buscador-container">
            
            <input 
                type="text" 
                name="buscar" 
                class="buscador-input" 
                placeholder="Buscar por nombre..." 
                value="<?php echo htmlspecialchars($busqueda); ?>"
            >
            
            <button class="buscador-btn" type="submit">Buscar</button>
        </form>

        <?php if (!empty($listado)): ?>
            <p class="error" style="text-align: center; margin-top: 1rem;"><?php echo $listado; ?></p>
        <?php endif; ?>
        
        <div class="productos-grid">
            <?php 
                if (!empty($productos)): 
                    foreach ($productos as $producto): 
            ?>
                <div class="producto-card">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    
                    <form method="post" action="inicio.php" class="personalizacion-form">
                        
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>"> 
                        
                        <button type="submit" name="añadir_al_carrito" class="btn-primary button">Añadir al Carrito</button>

                    </form>
                </div>
            <?php 
                    endforeach; 
                endif; 
            ?>
        </div>
            
        <?php echo $mensaje; ?> 

    </div>
</body>
</html>
