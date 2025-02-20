<?php

$pessoas = [];
$homens = 0;


for ($i = 0; $i < 3; $i++) {
    echo "Cadastro da pessoa " . ($i + 1) . ":\n";

    echo "Nome: ";
    $nome = readline();

    echo "Cidade: ";
    $cidade = readline();

    echo "Idade: ";
    $idade = readline();

    echo "Sexo (M/F): ";
    $sexo = strtoupper(readline());

    $pessoas[$i]= [

      "nome" => $nome,
        "cidade" => $cidade,
        "idade" => $idade,
        "sexo" => $sexo,
    ];

    if ($sexo == "M") {
        $homens++;
    }
    echo "\n";

}
echo "\nLista de cadastrados (nome e idade):\n";
foreach ($pessoas as $pessoa) {
    echo "Nome: {$pessoa['nome']} \nIdade: {$pessoa['idade']}\n";
}

echo "\nLista de moradores de Santos:\n";
foreach ($pessoas as $pessoa) {
    if (strtolower($pessoa['cidade'])=='santos') {
        echo "Nome: {$pessoa['nome']}\n";
    }
   
}

echo "\nLista de maiores de idade:\n";
foreach ($pessoas as $pessoa) {
    if ($pessoa['idade'] > 18) {
        echo "Nome: {$pessoa['nome']}\n";
    }
   
}

echo "\nQuantidade de pessoas do homem masculino: " . $homens."\n";



