<?php

echo "Digite sua nota final (1-10): ";
$nota=readline();

switch ($nota) {

    case $nota>=5 && $nota <=6:
        echo "Recuperação";
        break;

        case $nota>=7 && $nota <=10:
            echo "Aprovado";
            break;
        
    case $nota <5:
        echo "Reprovado";
        break;
    
    default:
        echo "Digite uma nota valida";
        break;
}