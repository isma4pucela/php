<?php
    $numeros = array(
        array(1,0,0,0,1),
        array(0,1,0,1,0),
        array(0,0,1,0,0),
        array(0,1,0,1,0),
        array(1,0,0,0,1)
    );

    $num = $numeros[0][0];
    $diagonal = true;

    for ($i=0; $i<5; $i++) {
    
        for ($j=0; $j<5; $j++) {

            if (($i == $j) and ($num != $numeros[$i][$j]) {
                $diagonal = false;
            }

        }

    }

    if ($diagonal == false) {
        echo ""
    } else {
        echo ""
    }
?>