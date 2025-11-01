<?php
    $array1 = array(1,2,3,4,5,6,7,8,9,10);
    $array2 = array(1,2,3,5,5,6,7,8,9,10);
    $iguales = true;

    for ($i=0; $i<10; $i++) {
        
        if ($array1[$i] != $array2[$i]) {
            $iguales = false;
        }

    }

    if ($iguales == true) {
        echo "Son iguales."
    }
?>