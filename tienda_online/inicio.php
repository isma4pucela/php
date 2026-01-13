<?php
    // Incluyo la conexión
    include_once "conexion.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // Compruebo que la conexión se haya realizado correctamente
    if (!isset($mysqli) || $mysqli->connect_error) {
        die("Error: No se pudo establecer la conexión con la base de datos. Por favor, revise 'conexion.php'.");
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

            $venta = "INSERT INTO ventas (id_usuario, id_producto, estado) VALUES ($id_usuario, $id_producto, 'carrito')";
            
            if ($mysqli->query($venta) === TRUE) {
                $mensaje = "<p>Producto añadido al carrito con éxito.</p>";
            } else {
                $mensaje = "<p>Error al registrar la venta: " . $mysqli->error . "</p>";
            }
        }
    }


    
    // Verifico si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
        $busqueda = $mysqli->real_escape_string($_POST['buscar']);
    }

    // Consulta base
    $select = "SELECT id_producto, nombre FROM productos"; 

    if ($busqueda !== "") {
        $select .= " WHERE nombre LIKE '%$busqueda%'"; 
    }

    $resultado = $mysqli->query($select);

    if ($resultado) {
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Error en SQL: " . $mysqli->error . " <br> Consulta enviada: " . $select;
    }
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
                    <h3><?php echo $producto['nombre']; ?></h3>
                    
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