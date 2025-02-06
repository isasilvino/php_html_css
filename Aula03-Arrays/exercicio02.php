<?php

$positivo =0;
$negativo = 0;
$par = 0;
$impar = 0;


for ($i=0; $i < 3; $i++) { 
    echo "Digite um número: ";
    $numero[] = readline();


    $numeros[]=[
        "numero" => $numero
    ];
}

for ($i=0; $i < 3; $i++) { 
    if ($numero [$i]>=0) {
        $positivo++;
   
    }else {
        $negativo++;
       
    }


}

for ($i=0; $i < 3; $i++) { 
    if ($numero [$i]%2==0) {
        $par++;
   
    } else{
        $impar++;
       
    }


}

echo "\nNumeros positivos: $positivo";
echo "\nNumeros negativos: $negativo";
echo "\nNumeros pares: $par";
echo "\nNumeros impares: $impar";



   
          
?>