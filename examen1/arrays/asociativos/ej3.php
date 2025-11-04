<?php
    $notas=array(
        "Maria"=>8,
        "Alonso"=>1,
        "Pedro"=>9,
        "Antonio"=>8,
        "Jose"=>3,
        "Roberto"=>5,
        "Cesar"=>6,
        "Mario"=>5,
        "Sergio"=>7,
        "Diego"=>4
    );

    $aprobado = 0;
    $suspenso = 0;
    $media = 0;
    $mediaap = 0;
    $mediasu = 0;  

    foreach ($notas as $alumno => $nota) {

        if ($clave>=5) {
            echo "$alumno ha aprobado.";
            $aprobado++;
            $media = $media + $nota;
            $mediaap
        } else {
            echo "$alumno ha suspendido.";
            $suspenso++;
        }

    }
?>