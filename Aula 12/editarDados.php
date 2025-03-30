<?php


session_start();
require 'db.php';




if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
   

    $db=db();
    $query = $db->prepare('SELECT nome, email, localizacao, website, bio FROM usuarios WHERE email = :email');
    $query->execute(['email' => $_SESSION['email']]);
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Erro ao carregar dados do usuário";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="acoes.php" method="post">  <h2>Editar minha conta</h2>

<input type="text" name="nome" value="<?=($usuario['nome']); ?>" required><br>

<br><input type="text" name="email" value="<?=($usuario['email']); ?>" required><br>
<br><input type="password"  name="senha"><br>

<br><label for="localizacao_user">Localização</label><br>
<input type="text" name="localizacao_user" value="<?=($usuario['localizacao']); ?>"><br>

<br><label for="website_user">WebSite</label><br>
<input type="text" name="website_user" value="<?=($usuario['website']); ?>"><br>

<br><label for="bio_user">Bio</label><br>
<input type="text" name="bio_user" value="<?=($usuario['bio']); ?>"><br>

<br><button type="submit" name="editar_usuario">Salvar Alterações</button>

<button type="submit" name="deletar_usuario">Deletar minha conta</button>
</form>

<br>
<a href="principal.php">
    <button type="button">Voltar</button>
</a>

</body>
</html>

