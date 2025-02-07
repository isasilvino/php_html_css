<?php

echo "Digite 2 numeros: ";
$numero = readline();
$numeroDois = readline();

function intervaloAleatorio($numero, $numeroDois){

    $random = rand ($numero, $numeroDois);

    echo $random;


}

intervaloAleatorio($numero, $numeroDois);

?>