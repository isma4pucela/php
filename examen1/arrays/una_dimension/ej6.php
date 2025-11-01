<?php
    $numeros = (6,5,13,4,7,9,7,39,16,13);

    for ($i=0; $i<10; $i++) {
        $primo = true;
        
        for ($j=2; $j<$numeros[$i]; $j++) {

            if (($numeros[$i] % $j) == 0) {
                $primo = false;
            }

        }

        if ($primo == true){
            echo $numeros[$i] "es primo. <br>"
        }

    }
?>