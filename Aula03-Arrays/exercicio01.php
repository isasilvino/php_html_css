<?php

$alunos = [];
$somaNotas = 0;
$maiorNota = 0;

for ($i=0; $i < 2; $i++) { 
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
for ($i=0; $i < 2; $i++) { 
    if ($alunos[$i]['nota'] > $maiorNota) {
        $maiorNota = $alunos[$i]['nota'];
       
    }
  
}

$mediaNotas = $somaNotas / 2;

    echo "\nLista de alunos e suas notas:\n";
    foreach ($alunos as $aluno){
        echo "Aluno: " . $aluno['nome'] . " - Nota: " . $aluno['nota'] . "\n";


    }
    echo "\nMedia da turma: {$mediaNotas}";
    echo "\nMaior nota da turma: {$maiorNota}";


 
 





?>
