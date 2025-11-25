<?php
// Incluyo conexión.php al archivo
include_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Oficial CD Rioseco</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <section class="banner">
        <div class="banner-texto">
            <h1>Bienvenido a la Tienda Oficial CD Rioseco</h1>
            <p class="banner-subtexto">Descubre la mejor ropa y accesorios oficiales del CD Rioseco</p>
        </div>
    </section>

    <section class="categorias">
        <div class="container">
            <h2>Nuestras Categorías</h2>
            <div class="categorias-grid">
                <a href="ropa_partido.php" class="categoria-card categoria-link">
                    <img src="imagenes/camiseta.png" class="categoria-imagen">
                    <h3>Ropa de partido</h3>
                    <p>Equipaciones oficiales del club</p>
                </a>
                <a href="ropa_calle.php" class="categoria-card categoria-link">
                    <img src="imagenes/calle.png" class="categoria-imagen">
                    <h3>Ropa de calle</h3>
                    <p>Cazadora, chándal y más</p>
                </a>
                <a href="accesorios.php" class="categoria-card categoria-link">
                    <img src="imagenes/accesorios.png" class="categoria-imagen">
                    <h3>Accesorios</h3>
                    <p>Mochilas y otros accesorios</p>
                </a>
            </div>
        </div>
    </section>
</body>
</html>
