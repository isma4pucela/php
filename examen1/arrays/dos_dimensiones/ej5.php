<?php
    $numeros = array(
        array(1,0,0,0,0),
        array(0,1,1,0,0),
        array(0,0,100,0,0),
        array(0,0,5,1,0),
        array(0,0,0,0,1)
    );

    $mas100=false;

    for ($i=0; $i<5; $i++) {
            
        for ($j=0; $j<5; $j++) {
            $suma = $suma + $numeros[$i][$j];

            if (($suma>100) and ($mas100 == false)) {
                $fila = $i;
                $columna = $j;
                $mas100 = true;
            }

        }
    }

    echo ""
?>