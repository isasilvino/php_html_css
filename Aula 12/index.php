<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-yellow-50 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-orange-600 mb-6">Bem-vindo ao <span class="bg-gradient-to-r from-orange-600 via-pink-700 to-pink-300 text-transparent bg-clip-text">Artify</span></h2>
        <form action="acoes.php" method="post">



            <br><label for="Email" class="text-gray-700 text-sm font-medium">Digite seu email</label><br>
            <input type="email" name="email" placeholder="E-mail" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" required>




            <br><label for="Senha" class="text-gray-700 text-sm font-medium"> Digite sua senha</label><br>
            <input type="password" name="senha" placeholder="Digite sua senha" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6" requiredv>



            <button type="submit" name="login_usuario" class="w-full py-3 bg-pink-300 text-white font-semibold rounded-lg hover:bg-pink-400 transition duration-200 mb-4">Login</button>



            <div class="text-center">
                <p class="text-gray-600 text-sm">Ainda não tem uma conta? <a href="cadastro.php"
                        class="text-yellow-500 font-semibold hover:text-yellow-600">Cadastrar</a></p>
            </div>

        </form>
</body>

</html>

<?php




?>