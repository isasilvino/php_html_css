<?php
include('db.php');

if (isset($_POST['cadastrar_usuario'])) {
    $query = db()->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');

    

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

if (isset($_POST['deletar_usuario']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];


    $query = db()->prepare('DELETE FROM  usuarios WHERE email = :email');

    

    $query->execute(['email'=> $email]);

    session_destroy();
    header('Location: index.php');
    exit;
}


if (isset($_POST['editar_usuario'])) {
    header('Location: editarDados.php');
    

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($senha)) {
        $query = db()->prepare('UPDATE usuarios SET nome = :nome, email = :email WHERE email = :email');
        $query->execute(['nome' => $nome, 'email' => $email, 'email' => $_SESSION['email']]);
    }else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $query = db()->prepare('UPDATE usuarios SET nome = :nome, email = :email WHERE email = :email');
        $query->execute(['nome' => $nome, 'email' => $email, 'email' => $_SESSION['email']]);
    }
    $_SESSION['email'] = $email;
    header('Location: principal.php');
    exit;
    }

