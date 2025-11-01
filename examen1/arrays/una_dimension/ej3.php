<?php
    $numeros = array(6,52,76,79,99);
    $ordenado = true;

    for ($i=0 ; $i<4 ; $i++) {
       
        if ($numeros[$i]>$numeros[$i+1]) {
            $ordenado = false;
        }
        
    }

    if ($ordenado == true) {
        echo "El array está ordenado.";
    } else {
        echo "El array no está ordenado.";
    }

?>

