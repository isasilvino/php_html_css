<?php
$numeros = [10, 40, 31, 53];

$numeros = array_filter($numeros, function($dado){
return ($dado % 2)== 0;

});


print_r($numeros);


//$numeros = array_filter($numeros, fn(%dado) => $dado % 2 ==0);
//print_r ($numeros);
?>