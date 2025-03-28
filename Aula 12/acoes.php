<?php
include('db.php');

if (isset($_POST['cadastrar_usuario'])) {
    $query = db()->prepare('INSERT INTO usuarios (nome, email,  ) VALUES (:nome, :email, :senha)');

    

    $query->execute([
        'nome' => $_POST['nome'],
        'email'=> $_POST['email'],
        'senha'=> password_hash($_POST['senha'], PASSWORD_DEFAULT)
    ]);
    header('Location: index.php');
}


if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['login_usuario'])) {
    $query = db()->prepare('SELECT * FROM usuarios WHERE email= :email');

    

    $query->execute([
        
        'email'=> $_POST['email']   
    ]);
    $user = $query->fetch();

    if (password_verify($_POST['senha'], $user['senha'])) {
        $_SESSION['email'] = $user['email'];
        header('Location: principal.php');
    }else {
        $_SESSION['mensagem'] = 'Email ou senha invalidos';
        header('Location: login.php');
    }
}


if (isset($_POST['deletar_usuario'])) {
    $query = db()->prepare('DELETE FROM  usuarios WHERE email = :?');

    

    $query->execute([
        'nome' => $_POST['nome'],
        'email'=> $_POST['email'],
        'senha'=> password_hash($_POST['senha'], PASSWORD_DEFAULT)
    ]);
    header('Location: index.php');
}
