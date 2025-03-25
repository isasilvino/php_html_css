<?php
$maior = 0;
echo "Escreva 10 valores:\n ";

for ($i = 0; $i < 3; $i++) {
    $numeros[] = readline();


}

foreach ($numeros as $numero) {
   echo "\n".$numero;
}
$maior = $numeros[0]; ///armazena o primeiro numero do array assumindo que seja o maior
foreach ($numeros as $numero) { //transformamos cada numero em uma variavel $numero
    if ($numero > $maior) { //compara cada variavel $numero com o numero salvo no $maior
        $maior = $numero; //quando maior que o numero salvo em $maior, ele eh substituido
        
    }
}
    echo "\nO maior numero é: {$maior}";

?>