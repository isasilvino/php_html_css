<?php
//a variavel controler recebe o valor index como 'padrão'
$controller = 'index';
//faz o if pra ver se existe algo extra na URL
if(isset($_SERVER['PATH_INFO'])){
    //se existe, ele define um novo nome pro controller
    $controller = str_replace('/', '', $_SERVER['PATH_INFO']);
}

//envia pra pagina que o controller foi nomeado
require "controllers/{$controller}.controller.php";
//por exemplo se o usuario acrescenta ao lado da barra (/) "livros", vai passar pela verificação do if, vai ver que tem info extra na URL (no caso 'livros'), vai adicionar ao controller e passar para a pagina que o controller foi nomeado (controllers/livros.controller.php)

?>

