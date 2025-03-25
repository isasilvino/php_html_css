<?php

echo "Digite um numero e calcule o seu fatorial: ";
$numero = readline();

function fatorial($numero){

    for ($i=0; $i < $numero ; $i++) { 
<<<<<<< HEAD
        $mult = $numero * $i++;
=======
        $mult = $numero * $i;
>>>>>>> 06cb5dbada5d7a7098de1d705676acbd51d04331
    }
    echo "O fatorial do numero é: {$mult}";
}

fatorial($numero);

?>