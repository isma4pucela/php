<?php
    // Compruebo si la sesión está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<nav class="navbar">
    <div class="container">
        <div class="navbar-brand" style="margin-left: 1rem;">
            <a href="inicio.php" class="logo">Tienda Oficial CD Rioseco</a>
            <img src="imagenes/rioseco.png" alt="Escudo CD Rioseco" class="logo-imagen">
        </div>

        <ul class="nav-menu">
            <li><a href="inicio.php" class="nav-link no-hover">Inicio</a></li>
            
            <?php 
                // Si la sesión está iniciada, muestro las opciones de cuenta
                if (isset($_SESSION['id_usuario'])) { 
            ?>
                    <li><a href="logout.php" class="nav-link no-hover">Cerrar Sesión</a></li>
                    <li><a href="baja.php" class="nav-link no-hover">Eliminar Cuenta</a></li>            
            <?php
                // Sino, muestro las opciones de login y registro
                } else {
            ?>
                <li><a href="login.php" class="nav-link no-hover">Iniciar Sesión</a></li>
                <li><a href="alta.php" class="nav-link no-hover">Registrarse</a></li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>