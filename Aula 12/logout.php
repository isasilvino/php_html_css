
<?php

//starta a sessao, desfaz a sessao e destroi a sessao = sai da conta
session_start();

session_unset();

session_destroy();

header('Location: index.php');

exit;

?>