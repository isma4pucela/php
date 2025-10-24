<?php
    //Dado un número calcular su sumatorio
    $num = 5;
    $sumatorio = 0;

    for ($i=1; $i<=$num; $i++) {
        $sumatorio = $sumatorio + $i;
    }
    
    echo "El sumatorio de los primeros $num números es: $sumatorio";
?>