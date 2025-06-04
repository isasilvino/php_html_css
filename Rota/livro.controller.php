<?php
//requisita o file dados.php onde contem os dados dos livros
require 'dados.php';

//pega o valor da URL e armazena na variavel $id
$id = $_REQUEST['id'];
//filtra o array pra encontrar o id do livro recebido
$filtrado = array_filter($livros, fn($l) => $l['id'] == $id);
//pega o ultimo ou unico livro encontrado e armazena na variavel $livro
$livro = array_pop($filtrado);
//define o valor da variavel $view como livro caso a pessoa n digite nada 
$view = 'livro';
//vai ate o app.php (views/template/ seria o caminho ate ele) e ele vai encaminhar pra view do livro com os dados recebidos no id e depois de filtrado
//ou seja, atraves de  <?php require "views/{$view}.view.php"; onde vai substituir {$view} por livro ele vai encaminhar pra livro.view.php
require "views/template/app.php";

?>