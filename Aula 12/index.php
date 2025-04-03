<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<!-- estilização do backgoung e do card onde ficam os inputs de login-->
<body class="bg-yellow-50 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-orange-600 mb-6">Bem-vindo ao <span class="bg-gradient-to-r from-orange-500 via-pink-600 to-pink-300 text-transparent bg-clip-text">Artify</span></h2>


<!-- chama a mensagem de acoes.php caso ocorra erro de login -->
 <?php if (isset($_SESSION['mensagem'])): ?>
    <!-- estilização do aviso -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">


 <!-- SPAN exibe a mensagem, php?= $_SESSION['mensagem'] ?php insere a mensagem no HTML para ser aparente ao usuario e a class="block sm:inline faz com que no celular o texto quebre a linha but porem inline em tela maior > sm:inline <-->
                <span class="block sm:inline"><?= $_SESSION['mensagem'] ?></span>
            </div>
 <!-- unset desfaz a mensagem pra se o user atualizar a pagina não estar la ainda -->
            <?php unset($_SESSION['mensagem']); ?>

 <!-- endif eh fechamento de if em php quando misturado com html que foi utilizado com o fim de php analisar a necessidade da mensagem e do html estilizar ela-->
        <?php endif; ?>
        



 <!-- no form utilizando action pra utilizar ao php chamado, nesse caso acoes.php e method pra inserir na variavel global $_POST os names -->
        <form action="acoes.php" method="post">
 <!-- label e input da area do email -->
            <br><label for="Email" class="text-gray-700 text-sm font-medium">Digite seu email</label><br>
            <input type="email" name="email" placeholder="E-mail" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" required>
<!-- label e input da area do senha -->
            <br><label for="Senha" class="text-gray-700 text-sm font-medium"> Digite sua senha</label><br>
            <input type="password" name="senha" placeholder="Digite sua senha" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6" required>
<!-- botao do tipo submit com o nome login_usuario utilizado em acoes pra fazer um if (se o usuario clicou no botao) -->
            <button type="submit" name="login_usuario" class="w-full py-3 bg-pink-300 text-white font-semibold rounded-lg hover:bg-pink-400 transition duration-200 mb-4">Login</button>

 <!-- href que o usuario eh encaminhado pro cadastro.php caso n tenha uma conta -->
            <div class="text-center">
                <p class="text-gray-600 text-sm">Ainda não tem uma conta? <a href="cadastro.php"
                        class="text-yellow-500 font-semibold hover:text-yellow-600">Cadastrar</a></p>
            </div>
        </form>
    </div>
</body>
</html>
