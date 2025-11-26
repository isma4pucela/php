<?php
    // Inicio la sesión
    session_start();

    // Vacío el array con los datos
    $_SESSION = array();

    //  Cierro la sesión
    session_destroy();

    // Redirijo al usuario a la página de inicio
    header("Location: inicio.php");
    exit();
?>