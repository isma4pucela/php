<?php
    for ($i=0; $i<5; $i++) {
        echo "<br>";
    
        for ($j=0; $j<5; $j++) {

            if ($i == $j) {
                 $arraydiagonal[$i][$j] = 1;
            } else {
                 $arraydiagonal[$i][$j] = 0;
            } 
        }
    
    }
?>