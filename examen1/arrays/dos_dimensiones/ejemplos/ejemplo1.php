<?php
    $num = array (
        array (1,2,3,4),
        array (5,6,7,8),
        array (9,10,11,12),
    );

    for ($i=0; $i<=2; $i++) {
        echo "<br>";
        
        for ($j=0; $j<=3; $j++) {
            echo $num[$i][$j];
        }
    }
?>