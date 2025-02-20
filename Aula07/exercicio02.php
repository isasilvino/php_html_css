<?php

echo "Digite 4 numeros:";
for ($i=0; $i < 4; $i++) { 
    $numeros[]= readline();
}

$numeros = array_filter($numeros, function($dado){


return ($dado % 2)==0;


});

echo "\nNumeros pares do array:\n";
print_r($numeros);


?>