<?php
session_start();
require 'db.php';


if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}


$db = db();
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
    <title>Perfil do usuario</title>
</head>

<body>
     

    <div>
    
        <p><?php echo htmlspecialchars($usuario['nome']); ?></p>
        <p> <?php echo htmlspecialchars($usuario['localizacao'] ?: ''); ?></p>
        <p><?php echo htmlspecialchars($usuario['website'] ?: ''); ?></p>
        <p><?php echo htmlspecialchars($usuario['bio'] ?: ''); ?></p>
    </div>

    <form action="acoes.php" method="post">


       


    </form>
    <a href="logout.php">
        <button type="button">Sair</button>
    </a>
    <a href="editarDados.php">
        <button type="button">Editar dados</button>
    </a>
</body>

</html>