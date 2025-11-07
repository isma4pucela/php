

<?php
$mysqli = new mysqli("localhost", "root", "", "ejemploiaw");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
	echo $mysqli->host_info . "\n";
}
$mysqli->close();
echo "Cerrada la conexión";
?>