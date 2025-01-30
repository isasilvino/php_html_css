<?php

echo "Você deseja: \n1)Somar \n2)Subtrair \n2)Multiplicar \n2)Dividir ";
$escolha = readline();


switch ($escolha) {
    case '1':

        echo "Digite o primeiro número: ";
        $numero = readline();

        echo "Digite o segundo número: ";
        $numeroDois = readline();

        $soma = $numero + $numeroDois;
        echo "Resultado da soma: {$soma}";
        break;

    case '2':

        echo "Digite o primeiro número: ";
        $numero = readline();

        echo "Digite o segundo número: ";
        $numeroDois = readline();

        $sub = $numero - $numeroDois;
        echo "Resultado da subtração: {$sub}";
        break;

    case '3':

        echo "Digite o primeiro número: ";
        $numero = readline();

        echo "Digite o segundo número: ";
        $numeroDois = readline();

        $mult = $numero * $numeroDois;
        echo "Resultado da multiplicação: {$mult}";
        break;

    case '4':

        echo "Digite o primeiro número: ";
        $numero = readline();

        echo "Digite o segundo número: ";
        $numeroDois = readline();

        $div = $numero / $numeroDois;
        echo "Resultado da divisão: {$div}";
        break;


    default:
        echo "Opção inválida";
        break;
}
