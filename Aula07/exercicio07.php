<?php

echo "Digite 4 numeros (positivos ou nao)\n";
for ($i=0; $i < 4; $i++) { 
    $numeros[] = readline();
}

$positivo = function ($numeros){

return ($numeros > 0);
};

$numeros = array_filter($numeros, $positivo);

echo "\nNumeros positivos:\n";
print_r($numeros);
?>