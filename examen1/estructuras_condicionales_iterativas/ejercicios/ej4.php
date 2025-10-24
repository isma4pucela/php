<?php
    //Generar enteros de 3 en 3 comenzando por 2 hasta el valor máximo menor que 30.
    //Calcular la suma de los enteros generados que sean divisibles por 5 e imprimirlo
    $suma = 0;

    for ( $i=2 ; $i<30 ; $i+=3 ){
        if ( $i % 5 == 0) {
            $suma = $suma + $i;
        }
    }
    
    echo $suma;
?>