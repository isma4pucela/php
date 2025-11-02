<?php
    $matriz=array(
        array(1,3,8,7,2),      
        array(5,6,7,2,600),
        array(5,6,7,2,100),
        array(5,6,7,10,2),
        array(5,5,5,5,20)
    );

    $maxfila = 0;

    for ($i=0; $i<5; $i++) {
        $suma = 0;

        for ($j=0; $j<5; $j++) {
            $suma = $suma + $matriz[$i][$j];
        }

        if ($suma > $maxfila) {
            $maxfila = $suma;
            $fila = $i;
        }
    }

    echo "La fila cuya números suman más es $fila"
?>