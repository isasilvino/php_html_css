<?php

$veiculos = [];

for ($i=1; $i <= 3; $i++) { 
    
    echo "Modelo: ";
    $modelo = readline();

    echo "Fabricante: ";
    $fabricante = readline();

    echo "Cor: ";
    $cor = readline();

    echo "Número de portas: ";
    $portas = readline();

    echo "Ano: ";
    $ano = readline();

    $veiculos[] = [
        'registro'=> $i,
        'modelo'=> $modelo,
        'fabricante'=> $fabricante,
        'cor'=> $cor,
        'portas'=> $portas,
        'ano'=> $ano

    ];

    echo "\n";

}

echo "\nLista de modelos:\n";

foreach ($veiculos as $veiculo) {
    echo "No. de registo: {$veiculo['registro']}, Modelo: {$veiculo['modelo']}, Ano: {$veiculo['ano']}\n";
}

echo"\nVeiculos com a cor prata:\n";
foreach ($veiculos as $veiculo) {
    if (strtolower($veiculo['cor'])== 'prata') {
        echo "No. de registo: {$veiculo['registro']}, Modelo: {$veiculo['modelo']}\n";
    }
}

echo "\nLista de veiculos (Cor e Portas):\n";

foreach ($veiculos as $veiculo) {
    echo "No. de registo: {$veiculo['registro']}, Modelo: {$veiculo['modelo']}, Cor: {$veiculo['cor']}, Portas: {$veiculo['portas']}\n";
}

echo"\nVeiculos da Ford:\n";
foreach ($veiculos as $veiculo) {
    if (strtolower($veiculo['fabricante']== 'ford')) {
        echo "No. de registo: {$veiculo['registro']}, Modelo: {$veiculo['modelo']}, Fabricante {$veiculo['fabricante']}\n";
    }
}

echo"\nVeiculos com fabricação a partir de 2013:\n";
foreach ($veiculos as $veiculo) {
    if ($veiculo['ano']>=2013) {
        echo "No. de registo: {$veiculo['registro']}, Modelo: {$veiculo['modelo']}, Ano: {$veiculo['ano']}\n";
    }
}

?>
