<?php

echo "Digite um numero e calcule o seu fatorial: ";
$numero = readline();

function fatorial($numero){

    for ($i=0; $i < $numero ; $i++) { 
        $mult = $numero * $i++;
    }
    echo "O fatorial do numero é: {$mult}";
}

fatorial($numero);

?>