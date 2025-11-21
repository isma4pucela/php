<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
   <head>  
      <title>Dar de alta usuario</title> 
      <meta http-equiv="Content-Type" content="text/html; 
	charset=iso-8859-1" />  
   </head>  
<body>  
<?php  
    include_once "conexion.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $mysqli->query("INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre','$email','$password')");  
        
        echo "Ha sido dado de alta <br>";
        
        $mysqli->close(); 
        echo 'Desconexión realizada.';
    }
    else {
?>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>
            
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required><br><br>
            
            <button type="submit">Dar de alta</button>
        </form>
<?php
    }
?>
</body>  
</html>
