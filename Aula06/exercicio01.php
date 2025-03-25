<?php

echo "Digite um numero: ";
$numero = readline();

function parOuImpar($numero){

    if ($numero %2==0 ) {
        echo "O numero é par";
    }else {
        echo "O numero é impar";
    }
}

parOuImpar($numero);
?>