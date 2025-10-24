<?php
    $temp = array("enero"=>3,"febrero"=>2,"marzo"=>15, "abril"=>19),                                                              "mayo"=>21,"junio"=>24,"julio"=>27,"agosto"=>31, "septiembre"=>19, "octubre"=>14,"noviembre"=>8,"diciembre"=>-1);    

    foreach ($temp as $clave=>$valor){

        echo "el mes de ".$clave."tiene una temperatura de".$valor ;

    }
?> 