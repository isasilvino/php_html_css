<?php

echo "Digite um valor e calcule o seu quadrado:";
$numero = readline();


$quadrado = function($numero){
return $numero * $numero;
};

echo "O quadrado de {$numero} é " . $quadrado($numero);

?> 