<?php
$meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];


echo "Digite o numero correspondente ao mes que deseja: ";
$opcao = readline();

echo $meses[$opcao-1];
?>
