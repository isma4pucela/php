<?php
// 1. Iniciar la sesión para acceder a las variables de sesión
session_start();

// 2. Limpiar el array $_SESSION (borra todas las variables de sesión)
$_SESSION = array();

// 3. Destruir la sesión completamente
session_destroy();
// NOTA: La redirección a 'inicio.php' se ha eliminado.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Cerrada - Tienda Oficial CD Rioseco</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="registro-container">
        <h1>Sesión Cerrada</h1>
        
        <p class="success">Has cerrado tu sesión con éxito.</p>
        
        <p>Puedes <a href="login.php" class="form-link">volver a iniciar sesión</a> o <a href="inicio.php" class="form-link">ir a la página principal</a>.</p>
    </div>
</body>
</html>