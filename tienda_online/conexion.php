<?php
$mysqli = new mysqli("localhost", "root", "", "isma");
if ($mysqli->connect_errno) {
    echo "Error de conexión: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>