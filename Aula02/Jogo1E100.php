<?php
$tentativa = 0;
$numeroCerto = rand(0, 100);

while ($tentativa != 5) {


    echo "Tente adivinhar o número aleatorio:";
    $numero = readline();

    if ($numero == $numeroCerto) {
        echo "Você acertou o número!";
        $tentativa = 5;
   
    }else if ($numero != rand()) {
        echo "Você errou o número.\n";
        $tentativa++;
    }
        
    }


?>
