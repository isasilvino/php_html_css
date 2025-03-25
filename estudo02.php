<?php

echo "Digite sua nota final (1-10):";
$nota = readline();

if ($nota >= 7 && $nota <= 10) {
    echo "Aprovado!";
} elseif ($nota >= 5 && $nota <= 6) {
    echo "Recuperaçao";
} elseif ($nota < 5) {
    echo "Reprovado.";
}
