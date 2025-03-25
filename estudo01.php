<?php

$anoAtual = 2024;

echo "Qual seu nome? ";
$nome = readline();

echo "Qual sua idade $nome? ";
$idade = readline();

echo "Por fim, qual sua cidade natal? ";
$cidade = readline();

$anoNasceu = $anoAtual -  $idade;

echo "Nome: $nome, idade: $idade, ano de nascimento: $anoNasceu, nascida em: $cidade";