<?php
    $numeros = array();
    $num = 2;

    for ($i=0; $i<10; $i++) {
        $numeros[$i] = $num;
        $num = $num + 2;
        echo $numeros[$i] "<br>;"
    }
?>