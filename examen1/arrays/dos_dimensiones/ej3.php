<?php
    $matriz=array(
        array(5,3,1,4,6),
        array(2,6,8,9,30),
        array(0,1,21,37,13),
        array(15,22,77,42,40),
        array(10,1,8,16,15)
    );

    $mayor = 0;

    for ($i=0; $i<5; $i++) {

        for ($j=0; $j<5; $j++) {

            if ($mayor < $matriz[$i][$j]) {
                $mayor = $matriz[$i][$j];
                $fila = $i;
                $columna = $j;
            }

        }

        echo "El mayor es $mayor y está en la fila $fila columna $columna."
    }
?>