<?php

$alunos = [];
$somaNotas = 0;

for ($i=0; $i < 10; $i++) { 
    echo "Digite o nome do aluno: ";
    $nome = readline();

    echo "Digite a nota do aluno {$nome}:";
    $nota = readline();

    $alunos[]=[
    "nome" => $nome,
    "nota" => $nota
    ];

    $somaNotas += $nota;
}

$mediaNotas = $somaNotas / 10;

    echo "Lista de alunos e suas notas:\n";
    foreach ($alunos as $aluno){
        echo "Aluno: " . $aluno['nome'] . " - Nota: " . $aluno['nota'] . "\n";


    }
    echo "\nMedia da turma: {$mediaNotas}";


 
 





?>
