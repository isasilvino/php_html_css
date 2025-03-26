<?php
include('db.php');

if (isset($_POST['cadastrar_usuario'])) {
    $query = db()->prepare('INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)');

    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query->execute([
        'nome' => $_POST['nome'],
        'senha' => $_POST['senha']
    ]);
}
