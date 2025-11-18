<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
   <head>  
      <title>Ejercicio con mysqli</title> 
      <meta http-equiv="Content-Type" content="text/html; 
	charset=iso-8859-1" />  
   </head>  
<body>  
<?php  
// Conexión a la base de datos 

$mysqli = new mysqli("localhost", "root", "", "isma");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
Else {
   $sql = "DELETE FROM Persona WHERE Nombre = 'Nadia'";  
   // Ejecución de la sentencia
   $mysqli->query($sql);  
	echo "Se han eliminado ".$mysqli->affected_rows." personas <br>"; 
   
 
$mysqli->close(); 
echo 'Desconexión realizada.';  
}  
  
?>  
</body>  
</html>