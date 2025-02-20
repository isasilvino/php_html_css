<?php

echo "Digite 4 numeros aleatorios: ";

for ($i=0; $i < 4; $i++) { 
    $numeros[] = readline();
}


print_r($numeros);

$dobraValor = array_map(function($numeros){
    return $numeros * 2;
    },$numeros);
    

    echo "\nValores dobrados:\n ";
    print_r ($dobraValor);


?>