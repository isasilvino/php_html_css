<?php
//requisita os dados que contem dentro de dados.php
require 'dados.php';
//da index como valor 'padrao' de view, caso a pessoa não digite nada
$view = "index";
//inclui o arquivo de app.php (view/template seria o caminho ate o arquivo) e eh como se colasse todo o codigo que tem la aqui.
//ou seja, atraves de  <?php require "views/{$view}.view.php"; onde vai substituir {$view} por index ele vai encaminhar pr index.view.php
require "views/template/app.php";

?>