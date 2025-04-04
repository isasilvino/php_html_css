<?php

if (!isset($_SESSION)) {
    session_start();
}

include('db.php');





$db = db();






// CADASTRAR PROJETO
if (isset($_POST['adicionar_projeto'])) {
    // Validar campos
    if (isset($_POST['nomeprojeto']) || isset($_POST['descricao'])) {
        // Salvar imagem
        $imagem = $_FILES['imagem'];
        $nomeImagem = uniqid() . '-' . basename($imagem['name']);
        $caminhoFinal = 'projetousuario/' . $nomeImagem;

        if (!move_uploaded_file($imagem['tmp_name'], $caminhoFinal)) {
            header("Location: cadastroprojeto.php?mensagem=Erro ao salvar a imagem");
            exit;
        }

        // Inserir no banco
        $query = db()->prepare("INSERT INTO projetos (titulo, descricao, imagem, usuario_id) VALUES (:titulo, :descricao, :imagem, :usuario_id)");
        $query->execute([
            'titulo' => $_POST['nomeprojeto'],
            'descricao' => $_POST['descricao'],
            'imagem' => $caminhoFinal,
            'usuario_id' => $_SESSION['usuario_id']
        ]);

        header("Location: principal.php?mensagem=Projeto cadastrado com sucesso!");
        exit;
    }
}


if (isset($_POST['deletar_projeto'])) {
    
    try {



        $query = db()->prepare("DELETE FROM projetos WHERE usuario_id = :usuario_id AND id = :id");

        $query->execute([
            'usuario_id' => $_POST['usuario_id'],
            'id' => $_POST['id']

        ]);
        header('Location: principal.php?mensagem=Projeto excluído com sucesso!');
    } catch (\Throwable $th) {
        throw $th;
    }
}



if (isset($_POST['editar_projeto'])) {
    $db = db();

    $query = $db->prepare("SELECT * FROM projetos WHERE id = :id AND usuario_id = :usuario_id");
    $query->execute([
        'id' => $_POST['id'],
        'usuario_id' => $_SESSION['usuario_id']
    ]);

    if ($query->fetch()) {
        $update = $db->prepare("UPDATE projetos SET titulo = :titulo, descricao = :descricao WHERE id = :id");
        $update->execute([
            'titulo' => $_POST['nomeprojeto'],
            'descricao' => $_POST['descricao'],
            'id' => $_POST['id']
        ]);
        header('Location: principal.php?mensagem=Projeto alterado com sucesso!');
    } else {
        header('Location: principal.php?mensagem=Erro: projeto não encontrado ou acesso negado!');
    }
    exit;
}


if (isset($_POST['pesquisar_projeto'])) {
    $query = db()->prepare('SELECT * FROM projetos where titulo like :titulo');
    $query->execute([
        'titulo' =>  $_POST['nomeprojeto']
    ]);
}
