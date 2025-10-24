<?php
    $nombre=$_REQUEST["nombre"];
    $apellido=$_REQUEST["apellido"];
    $ciudad=$_REQUEST["ciudad"];
    $estado=$_REQUEST["estado"];

    echo "Bienvenido $nombre $apellido <br>";
    echo "Usted vive en $ciudad <br>";
    echo "Su estado actual es $estado <br>";
?>