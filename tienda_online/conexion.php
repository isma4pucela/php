<?php
$mysqli = new mysqli("fdb1032.awardspace.net", "4712043_isma", "ASIR2-isma", "4712043_isma");
if ($mysqli->connect_errno) {
    echo "Error de conexión: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
