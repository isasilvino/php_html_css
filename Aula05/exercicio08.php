<?php
$numeros = [1, 2, 3, 4, 5];

$dobraValor = array_map(function($numeros){
return $numeros * 2;
},$numeros);

var_dump($dobraValor);



?>