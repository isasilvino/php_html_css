<?php
echo "Digite 4 numeros:";

for ($i=0; $i < 4; $i++) { 
   $numero[]= readline();
}

$cubo = array_map (function($numero){
    return $numero * $numero * $numero;
    }, $numero);
    
    print_r($cubo);
    

?>