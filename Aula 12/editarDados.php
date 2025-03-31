<?php


session_start();
require 'db.php';




if (!isset($_SESSION['email'])) {
    header('Location:login.php');
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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-yellow-100 min-h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-purple-700 mb-6 text-center">Editar minha conta</h2>
        <form action="acoes.php" method="post" class="space-y-4">
        <div>
    <label class="block text-gray-700 font-medium">Usuário</label>
    <input type="text" name="nome" id="username"
        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
        value="<?= isset($usuario['nome']) ? (strpos($usuario['nome'], '@') === 0 ? $usuario['nome'] : '@' . $usuario['nome']) : ''; ?>"
        required>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let input = document.getElementById("username");

            // garante que o nome sempre inicie com @ e tbm mantem o user
            if (!input.value.startsWith("@")) {
                input.value = "@" + input.value.replace(/@/g, ""); // Garante que não haja múltiplos @
            }

            input.addEventListener("input", function() {
                // impede que o user coloque mais de um @
                if (!input.value.startsWith("@")) {
                    input.value = "@" + input.value.replace(/@/g, "");
                }
            });
        });
    </script>
</div>

            <div>
                <label class="block text-gray-700 font-medium">E-mail</label>
                <input type="email" name="email"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                    value="<?= htmlspecialchars($usuario['email']); ?>" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Nova Senha <span class="text-xs text-gray-500">(opcional)</span></label>
                <input type="password" name="senha"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                    placeholder="Digite uma nova senha se desejar alterar">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Localização <span class="text-xs text-gray-500">(opcional)</span></label>
                <input type="text" name="localizacao_user"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                    value="<?= htmlspecialchars($usuario['localizacao']); ?>">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Website <span class="text-xs text-gray-500">(opcional)</span></label>
                <input type="text" name="website_user"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                    value="<?= htmlspecialchars($usuario['website']); ?>">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Bio <span class="text-xs text-gray-500">(opcional)</span></label>
                <input type="text" name="bio_user"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                    value="<?= htmlspecialchars($usuario['bio']); ?>">
            </div>
            <div class="flex space-x-4 mt-6">
                <button type="submit" name="editar_usuario"
                    class="w-full py-3 bg-purple-500 text-white font-bold rounded-lg hover:bg-purple-600 transition duration-200">
                    Salvar Alterações
                </button>

                <button type="submit" name="deletar_usuario"
                    class="w-full py-3 bg-pink-500 text-white font-bold rounded-lg hover:bg-pink-600 transition duration-200">
                    Deletar minha conta
                </button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <a href="principal.php" class="text-purple-700 font-semibold hover:underline">Voltar</a>
        </div>
    </div>

</body>

</html>