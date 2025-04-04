<?php
include('db.php');
$query = db()->prepare("INSERT INTO projetos (titulo, descricao, usuario_id) VALUES (:titulo, :descricao, :usuario_id)");
$query->execute([
    'titulo' => $_POST['nomeprojeto'],
    'descricao' => $_POST['descricao'],
    'usuario_id' => $usuario_id
]);
?>