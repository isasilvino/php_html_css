<?php

echo "Digite 4 palavras: ";
for ($i=0; $i < 4; $i++) { 
    $palavras [] = readline();
}
print_r($palavras);

$ordenarPorTamanho = function($a, $b) {
    return strlen($a) - strlen($b);
};


usort($palavras, $ordenarPorTamanho);
echo "Ordenado por caracteres: ";
print_r($palavras); 

?>