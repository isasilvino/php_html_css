<?php
session_start();
include('db.php');

// CADASTRO DE USUARIO
if (isset($_POST['cadastrar_usuario'])) {
    $db = db();
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
        $_SESSION['dados_formulario'] = $_POST;
        header('Location: cadastro.php');
        exit;
    }


    if ($senha !== $confirmar_senha) {
        $_SESSION['mensagem'] = "As senham precisam ser iguais.";
        $_SESSION['dados_formulario'] = $_POST;
        header('Location: cadastro.php');
        exit;
    }

    if ($nome[0] !== '@') {
        $nome = '@' . ltrim($nome, '@');
    }


    $query = db()->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');
    $query->execute([
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
    ]);
    header('Location: index.php');
    exit;
}

//LOGIN DE USUARIO

if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['login_usuario'])) {
    $query = db()->prepare('SELECT * FROM usuarios WHERE email= :email');



    $query->execute([

        'email' => $_POST['email']
    ]);
    $user = $query->fetch();

    if (password_verify($_POST['senha'], $user['senha'])) {
        $_SESSION['email'] = $user['email'];
        header('Location: principal.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Email ou senha invalidos';
        header('Location: index.php');
        exit;
    }
}

//DELETAR CONTA

if (isset($_POST['deletar_usuario']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];


    $query = db()->prepare('DELETE FROM  usuarios WHERE email = :email');



    $query->execute(['email' => $email]);

    session_destroy();
    header('Location: index.php');
    exit;
}

//EDITAR INFORMAÇÕES DE USUARIO

if (isset($_POST['editar_usuario'])) {



    $nome = $_POST['nome'];
    $novoEmail = $_POST['email'];
    $senha = $_POST['senha'];
    $localizacao = isset($_POST['localizacao_user']) ? $_POST['localizacao_user'] : NULL;
    $website = isset($_POST['website_user']) ? $_POST['website_user'] : NULL;
    $bio = isset($_POST['bio_user']) ? $_POST['bio_user'] : NULL;
    $email = $_SESSION['email'];

    if ($nome[0] !== '@') {
        $nome = '@' . ltrim($nome, '@');
    }



    if (empty($senha)) {

        $query = db()->prepare('UPDATE usuarios SET nome = :nome, email = :novoEmail, localizacao = :localizacao, website = :website, bio = :bio WHERE email = :email');

        $query->execute([
            'nome' => $nome,
            'novoEmail' => $novoEmail,

            'localizacao' => $localizacao,
            'website' => $website,
            'bio' => $bio,
            'email' => $_SESSION['email']
        ]);
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $query = db()->prepare('UPDATE usuarios SET nome = :nome, email = :novoEmail, localizacao = :localizacao, website = :website, bio = :bio WHERE email = :email');
        $query->execute([
            'nome' => $nome,
            'novoEmail' => $novoEmail,
            'localizacao' => $localizacao,
            'website' => $website,
            'bio' => $bio,
            'email' => $_SESSION['email']
        ]);
    }
    $_SESSION['email'] = $novoEmail;
    header('Location: editarDados.php');
    exit;
}

if (isset($_POST['salvar_imagem'])) {
    
        // Define o diretório de destino
        $diretorio = 'images/';
        $arquivo = $diretorio . basename($_FILES['imagem']['name']);


   // Move o arquivo para a pasta de uploads
   if (move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo)) {
    // Salva no banco de dados apenas o caminho relativo da imagem
    $query = db()->prepare("UPDATE usuarios SET imagem =:imagem");
    $query->execute([
      
        'imagem' => $arquivo
    ]);
    
    header('Location: editarDados.php');
    exit;
}else {
    echo "nop";
}

}
?>