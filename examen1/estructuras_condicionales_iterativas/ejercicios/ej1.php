<?php
    // Escribe un programa que muestra la tabla de multiplicar del 1 al 10 de un número.
    $num = rand (1, 10);
    
    for ($i=1; $i<=10; $i++) {
        $resultado = $num * $i;
        echo "$num x $i = $resultado <br>";
    }
?>