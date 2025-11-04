<?php
    $suma = 0;
    $producto = 1;
    
    for ($i=0; $i<10; $i++) {
        
        if ($i%2 == 0) {
            $suma = $suma + $i;
        }

        if ($i%5 == 0) {
            $producto = $producto * $i;
        }

    }

    echo "La suma de los pares es $suma y el producto de los múltiplos de 5 es $producto."
?>