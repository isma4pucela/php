<?php
    $numeros = array(2,3,5,7,4,64,55,43,65,112,99,32,67,90,12,1,71,19,91,24);
    $max = 0

    for ($i=0; $i<20; $i++) {
        
        if ($numeros[$i] > $max) {
            $max = $numeros[$i];
            $posicion = $i;
        }
        
    }

    echo "El mayor es $max en la posición $posicion.";
?>