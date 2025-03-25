<?php

echo "Todos os produtos com 10% de desconto! \nDigite o valor da sua compra: ";
$valor = readline();


function desconto($valor){

    $porcent = ($valor * 10) / 100;
    return $valor - $porcent;
 
}

echo "O valor da sua compra fica: ";
echo desconto($valor);
