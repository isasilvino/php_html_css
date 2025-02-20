<?php
$chaves = ["nome", "idade", "curso"];
$valores = ["Isadora", 21, "ADS"];

$combinado = array_combine($chaves, $valores);

print_r($combinado);
?>