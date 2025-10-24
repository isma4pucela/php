<?php
    //Escribe un programa que muestre la tabla de multiplicar de los 5 primeros números
    for ( $i=1 ; $i <=5 ; $i++ ){
        echo "<br/> Tabla de multiplicar del $i <br/>";
        
        for ( $j=1 ; $j <=10 ; $j++ ) {
            $resultado = $i * $j;
            echo "<br>$i * $j = $resultado";
        }
    
    }
?>