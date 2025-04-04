
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
        $_SESSION['mensagem'] = "As senhas precisam ser iguais.";
        $_SESSION['dados_formulario'] = $_POST;
        header('Location: cadastro.php');
        exit;
    }

    if ($nome[0] !== '@') {
        $nome = '@' . ltrim($nome, '@');
    }

    $query = db()->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');
    $query->execute([
        'nome' => $nome, // Usando a variável $nome corrigida
        'email' => $email,
        'senha' => password_hash($senha, PASSWORD_DEFAULT)
    ]);
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login para continuar.";
    header('Location: index.php');
    exit;
}

// LOGIN DE USUARIO
if (isset($_POST['login_usuario'])) {
    $query = db()->prepare('SELECT * FROM usuarios WHERE email = :email');
    $query->execute([
        'email' => $_POST['email']
    ]);
    $user = $query->fetch();

    if (isset( $user) && password_verify($_POST['senha'], $user['senha'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['usuario_id'] = $user['id']; 
        header('Location: principal.php');
        exit;
    } else {
       
        $_SESSION['mensagem'] = 'Email ou senha inválidos';
        header('Location: index.php');
        exit;
    }
}


//DELETAR CONTA
if (isset($_POST['deletar_usuario']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // obtém a imagem do usuário antes de excluir
    $query = db()->prepare('SELECT imagem FROM usuarios WHERE email = :email');
    $query->execute(['email' => $email]);
    $imagem = $query->fetchColumn();

    // excluir o usuário
    $query = db()->prepare('DELETE FROM usuarios WHERE email = :email');
    $query->execute(['email' => $email]);

    // exclui a imagem do servidor se existir e não for a padrão
    if (!empty($imagem) && file_exists($imagem) && $imagem != 'images/default.jpg') {
        unlink($imagem);
    }

    session_destroy();
    $_SESSION['mensagem'] = "Sua conta foi excluída com sucesso.";
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
            'email' => $email
        ]);
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $query = db()->prepare('UPDATE usuarios SET nome = :nome, email = :novoEmail, senha = :senha, localizacao = :localizacao, website = :website, bio = :bio WHERE email = :email');
        $query->execute([
            'nome' => $nome,
            'novoEmail' => $novoEmail,
            'senha' => $senha_hash, // Adicionando a senha no UPDATE
            'localizacao' => $localizacao,
            'website' => $website,
            'bio' => $bio,
            'email' => $email
        ]);
    }
    $_SESSION['email'] = $novoEmail;
    $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
    header('Location: editarDados.php');
    exit;
}

// SALVAR IMAGEM DE PERFIL
if (isset($_POST['salvar_imagem'])) {
    if (!isset($_SESSION['email'])) {
        $_SESSION['mensagem'] = "Você precisa estar logado para alterar sua imagem.";
        header('Location: index.php');
        exit;
    }
    
    $email_usuario = $_SESSION['email'];
    
    // define o diretório de destino
    $diretorio = 'images/';
    
    // verifica se o diretório existe, se não, cria
    if (!file_exists($diretorio)) {
        mkdir($diretorio, 0777, true);
    }
    
    // verifica se um arquivo foi enviado
    if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] != UPLOAD_ERR_OK) {
        $_SESSION['mensagem'] = "Erro no upload da imagem.";
        header('Location: editarDados.php');
        exit;
    }
    
    // validação do tipo de arquivo
    $tipo_permitido = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $file_type = $_FILES['imagem']['type'];
    
    if (!in_array($file_type, $tipo_permitido)) {
        $_SESSION['mensagem'] = "Tipo de arquivo não permitido. Use apenas imagens (JPG, PNG, WEBP).";
        header('Location: editarDados.php');
        exit;
    }
    
    // validação do tamanho do arquivo (máximo 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB em bytes
    if ($_FILES['imagem']['size'] > $max_size) {
        $_SESSION['mensagem'] = "O arquivo é muito grande. O tamanho máximo permitido é 5MB.";
        header('Location: editarDados.php');
        exit;
    }
    
    // gera um nome único pro arquivo p evitar sobrescrever arquivos que ja existem
    $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $novo_nome = uniqid() . '.' . $extensao;
    $arquivo = $diretorio . $novo_nome;

    // obtém a imagem antiga do banco de dados antes de atualizar
    $query = db()->prepare("SELECT imagem FROM usuarios WHERE email = :email");
    $query->execute(['email' => $email_usuario]);
    $imagem_antiga = $query->fetchColumn();

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo)) {
        // se houver uma imagem antiga e ela não for a padrão, apaga o arquivo
        if (!empty($imagem_antiga) && file_exists($imagem_antiga) && $imagem_antiga != 'images/default.jpg') {
            unlink($imagem_antiga);
        }

        
        $query = db()->prepare("UPDATE usuarios SET imagem = :imagem WHERE email = :email");
        $query->execute([
            'imagem' => $arquivo,
            'email' => $email_usuario
        ]);

        $_SESSION['mensagem'] = "Imagem atualizada com sucesso!";
        header('Location: editarDados.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao salvar a imagem.";
        header('Location: editarDados.php');
        exit;
    }
}



    
   
    
    
?>
