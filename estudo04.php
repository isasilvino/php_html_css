<?php

echo "Digite um numero: ";
$numero = readline();


for ($i=0; $i <= 10; $i++) { 
    $mult = $numero * $i;

   echo $mult."\n";
}