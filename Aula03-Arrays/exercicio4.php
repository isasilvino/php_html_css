<?php

$numeros = [];
$numeros2= [];

echo" Digite 10 numeros para a primeira tabela:\n ";

for ($i=0; $i < 3; $i++) { 
    $numero =  readline();

    $numeros[$i] = $numero;
}

echo" Digite 10 numeros para a segunda tabela:\n ";

for ($i=0; $i < 3; $i++) { 
    $numero2 =  readline();

    $numeros2[$i] = $numero2;
}
echo  "\nPrimeira tabela:\n";
foreach ($numeros as $tabela) {
    echo  "\n".$tabela;
}

echo  "\nSegunda tabela:\n";
foreach ($numeros2 as $tabela2) {
    echo  "\n".$tabela2;
}

echo "\nVamos multiplicar os numeros da primeira tabela pela segunda tabela:\n ";
for ($i=0; $i < count($numeros); $i++) { 
    
$mult[]= $numeros[$i] * $numeros2[$i];

}
foreach ($mult as $resultados) {
    echo $resultados."\n";
}

?>
