<?php
    $numeros = array(3,4,3,1,5,9,2,9,1,5);
    $num = 7;
    $esta = false;

    for ($i=0; $i<10; $i++) {
        
        if ($num == $numeros[$i]) {
            $esta = true;
        }
        
    }

    if ($esta == true) {
        echo "$num está dentro del array."
    } else {
        echo "$num no está dentro del array."
    }
?>