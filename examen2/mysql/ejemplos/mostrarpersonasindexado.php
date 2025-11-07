<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
   <head>  
      <title>Ejercicio con mysqli</title> 
      <meta http-equiv="Content-Type" content="text/html; 
	charset=iso-8859-1" />  
   </head>  
<body>  
<?php  
// Conexión a la base de datos 

$mysqli = new mysqli("localhost", "root", "", "ejemploiaw");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
Else {
   // Ejecución de la consulta  
   $resultado = $mysqli->query('SELECT * FROM persona'); 
   if ($resultado == FALSE) {  
      echo "Error en la ejecución de la consulta.<br />"; 
   }     
   else {  
      // Examinar el número de registros 
      echo 'Número de personas: '.$resultado->num_rows .'<br />'; 
	  while ($registro = $resultado->fetch_row()) {  
         // Examinar apellidos y nombre de las personas   
         echo "Apellidos:".$registro[2]." y nombre:".$registro[1]."<br />"; 
      }     

   }  
     
$mysqli->close(); 
echo 'Desconexión realizada.<br /';  
}  
  
?>  
</body>  
</html>