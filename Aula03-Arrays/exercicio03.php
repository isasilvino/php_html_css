<?php
 echo "Digite 10 números: ";

for ($i=1; $i <= 3; $i++) { 
    
    $numero= readline();
    $numeros[]=[
        "numero" => $numero
    ];

}

echo "Digite um numero para multipicar o restante dos numeros: ";
$multiplicador = readline();

foreach ($numeros as $numeral) {
   $numeral = $numero * $multiplicador;
   
}

echo "\n". $numeros['numeral'];
?>