<?php
    $numeros = array(6,5,1,2,6,8,2,9,1,5);
    $suma = 0;

    for ($i=0; $i<10; $i++); {
        
        if ($i%2 == 0) {
            $suma = $suma + $numeros[$i];
        }

    }

    echo "La suma de las posiciones pares es $suma."
?>