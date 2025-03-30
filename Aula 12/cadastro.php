<?php
session_start();
if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
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

<form action="acoes.php" method="post">  

<label for="Nome"> Digite seu usuario</label><br>
<input type="text" name="nome" placeholder="Usuario" value="<?php echo isset($_SESSION['dados_formulario']['nome']) ? $_SESSION['dados_formulario']['nome'] : ''; ?>" required>


<br><label for="Email">Digite seu email</label><br>
<input type="email" name="email" placeholder="E-mail" value="<?php echo isset($_SESSION['dados_formulario']['email']) ? $_SESSION['dados_formulario']['email'] : ''; ?>" required>




<br><label for="Senha"> Digite sua senha</label><br>
<input type="password" name="senha">

<br><label for="confirmar_senha"> Confirme sua senha</label><br>
<input type="password" name="confirmar_senha">

<label>
        <input type="checkbox" name="termos"  <?php echo isset($_POST['termos']) ? 'checked' : ''; ?> required>
        Tenho 16 anos e concordo com os termos de uso
    </label><br><br>


<button type="submit" name="cadastrar_usuario">Cadastrar</button>

</form>

<a href="index.php">
    <button type="button">Voltar</button>
</a>
</body>
</html>

