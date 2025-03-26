<?php
include('db.php');

if (isset($_POST['cadastrar_usuario'])) {
    $query = db()->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');

    

    $query->execute([
        'nome' => $_POST['nome'],
        'email'=> $_POST['email'],
        'senha'=> password_hash($_POST['senha'], PASSWORD_DEFAULT)
    ]);
}

