<?php


session_start();
require 'db.php';

if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
   

    $db=db();
    $query = $db->prepare('SELECT nome, email FROM usuarios WHERE email = :email');
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

<input type="text" name="nome" value="<?=($usuario['nome']); ?>" required>
<input type="text" name="email" value="<?=($usuario['email']); ?>" required>
<input type="password"  name="senha">

<button type="submit" name="editar_usuario">Salvar Alterações</button>


</form>

<br>
<a href="principal.php">
    <button type="button">Voltar</button>
</a>
</body>
</html>

