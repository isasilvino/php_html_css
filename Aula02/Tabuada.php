<?php

echo "Digite um número para ver sua tabuada: ";
$numero = readline();

for ($i=0; $i <= 10; $i++) { 
    $mult = $i * $numero;

    echo "$numero X $i = $mult\n";
    
}

?>