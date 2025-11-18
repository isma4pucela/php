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
   // Ejecución de la consulta  
   $mysqli->query("INSERT INTO Persona (id_persona, Nombre, Apellidos, Edad) VALUES (1,'Rodrigo','Goles',22)");  
  
	  echo "ha sido dado de alta <br> ";
 
$mysqli->close(); 
echo 'Desconexión realizada.';  
}  
  
?>  
</body>  
</html>