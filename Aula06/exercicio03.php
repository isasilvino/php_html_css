<?php
echo "Digite uma palavra: ";
$palavra = readline();


function palindroma ($palavra){

    if ($palavra == strrev($palavra) ) {
        echo "Palavra palindroma";
    }else {
        echo "Não é uma palavra palindroma";
    }
}

palindroma($palavra);

?>