<?php
    //Dada una secuencia de 10 números generados de forma aleatoria determinar el mayor de los pares leídos.
    $mayor = 0;

    for ($i=0; $i<10; $i++) {
        $num = rand(1, 100);
        echo "Número generado: $num <br>";

            if ($num % 2 == 0 && $num > $mayor) {
                $mayor = $num;
            }
    }

    echo "El mayor de los números pares generados es: $mayor";
?>