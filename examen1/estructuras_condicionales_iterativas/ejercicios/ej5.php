<?php
    //Dada la base y el exponente y calcular la potencia.
    $base = 3;
    $exponente = 4;
    $resultado = 1;

    for ($i=0; $i<$exponente; $i++) { 
        $resultado = $resultado * $base;
    }

    echo "El resultado de $base elevado a la $exponente es: $resultado";
?>