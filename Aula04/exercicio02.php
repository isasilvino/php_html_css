<?php

$tarefas = [

    1 => "fazer caminhada",
    2 => "fazer almoço"
];

$tarefasDois = [

    3 => "alimentar doguinhos",
    4 => "estudar"
];

$tarefasCompletas = array_merge($tarefas, $tarefasDois);

print_r($tarefasCompletas);

?>