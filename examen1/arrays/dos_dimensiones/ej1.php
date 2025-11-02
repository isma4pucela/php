<?php
    $array1 = array(
        array (3,7,6),
        array (6,4,6) 
    );

    $array2 = array(
        array (3,7,8),
        array (6,1,5) 
    );

    for ($i=0; $i<2; $i++) {
        echo "<br>";

        for ($j=0; $j<3; $j++) {
            $arraysuma[$i][$j] = $array1[$i][$j] + $array2[$i][$j];
            echo $arraysuma[$i][$j]." ";
        }

    }
?>