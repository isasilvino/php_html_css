<?php

echo "Informe um valor e vamos verificar se é par ou ímpar: ";
$numero = readline();

if ($numero % 2 == 0 && $numero !=0) {
    echo "O número é par";
} else if ($numero % 2 != 0) {
    echo "O número é ímpar";
} else if ($numero == 0){
    echo "O número é zero";
}

    ?>
