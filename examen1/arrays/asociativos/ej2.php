<?php
    $temp = array(
        "enero" => 3,
        "febrero" => 2,
        "marzo" => 15,
        "abril" => 19,
        "mayo" => 21,
        "junio" => 24,
        "julio" => 27,
        "agosto" => 31,
        "septiembre" => 19,
        "octubre" => 14,
        "noviembre" => 8,
        "diciembre" => -1
    );

    $max = $temp["enero"];
    $min = $temp["enero"];

    foreach ($temp as $clave => $val) {
        
        if ($val >= $max) {
            $max = $val;
            $mesmayor = $clave;
        } elseif ($valor <= $min) {
            $min = $val;
            $mesmenor = $clave;
        }

    }

    echo ""
?>