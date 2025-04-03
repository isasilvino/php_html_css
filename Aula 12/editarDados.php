<?php
session_start();
require 'db.php';

if (!isset($_SESSION['email'])) {
    header('Location:index.php');
    exit;
}

$db = db();
$query = $db->prepare('SELECT nome, email, localizacao, website, bio, imagem FROM usuarios WHERE email = :email');
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
    <title>Editar perfil</title>
</head>

<body class="bg-yellow-100 min-h-screen">
    
    <header class="bg-gradient-to-r from-yellow-500 via-rose-400 to-pink-600 h-16 w-full shadow-md fixed top-0 z-50"></header>

    <!-- conteudo principal com padding-top p compensar o header q eh fixo -->
    <div class="container mx-auto px-4 pt-20 pb-6">
        <!-- card principal com margem  -->
        <div class="bg-white rounded-xl shadow-xl p-8 mx-auto max-w-5xl mb-8">
            <h2 class="text-2xl font-bold text-orange-600 mb-6 text-center">Editar meu perfil</h2>

            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?= $_SESSION['mensagem'] ?></span>
                </div>
                <?php unset($_SESSION['mensagem']); ?>
            <?php endif; ?>

            <!-- foto do user -->
            <div class="flex flex-col items-center mb-8">
                <!-- foto de perfil atual -->
                <div class="w-32 h-32 bg-blue-300 rounded-full overflow-hidden mb-4">
                    <?php if (!empty($usuario['imagem'])): ?>
                        <img src="<?= htmlspecialchars($usuario['imagem']); ?>"  class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="flex items-center justify-center w-full h-full text-white text-xl font-bold">IMG</span>
                    <?php endif; ?>
                </div>

                <!--  upload de imagem -->
                <form action="acoes.php" method="post" class="w-full max-w-md" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2 text-center">Alterar foto de perfil</label>
                        <input type="file" name="imagem" class="w-full p-2 border border-gray-300 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1 text-center">Formatos aceitos: JPG, PNG, WEBP. Tamanho máximo: 5MB</p>
                    </div>
                    <button type="submit" name="salvar_imagem" class="w-full py-2 bg-pink-400 text-white font-bold rounded-lg hover:bg-pink-500 transition duration-200">
                        Atualizar foto
                    </button>
                </form>
            </div>

            <!-- edição de perfil em duas colunas -->
            <form action="acoes.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- coluna esquerda: infos do perfil -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-rose-600 mb-3">Informações de perfil</h3>
                        
                        <div>
                            <label class="block text-gray-700 font-medium">Usuário</label>
                            <input type="text" name="nome" id="username"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                                value="<?= isset($usuario['nome']) && $usuario['nome'] !== null ? (strpos($usuario['nome'], '@') === 0 ? $usuario['nome'] : '@' . $usuario['nome']) : ''; ?>"
                                required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium">Localização <span class="text-xs text-gray-500">(opcional)</span></label>
                            <input type="text" name="localizacao_user"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                                value="<?= isset($usuario['localizacao']) ? htmlspecialchars($usuario['localizacao']) : ''; ?>">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium">Website <span class="text-xs text-gray-500">(opcional)</span></label>
                            <input type="text" name="website_user"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                                value="<?= isset($usuario['website']) ? htmlspecialchars($usuario['website']) : ''; ?>">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium">Bio <span class="text-xs text-gray-500">(opcional)</span></label>
                            <textarea name="bio_user" rows="3"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400"
                            ><?= isset($usuario['bio']) ? htmlspecialchars($usuario['bio']) : ''; ?></textarea>
                        </div>
                    </div>

                    <!-- coluna direita: infos da conta -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-rose-600 mb-3">Informações de conta</h3>
                        
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
                        
                        <div class="pt-8">
                            <button type="submit" name="editar_usuario"
                                class="w-full py-3 bg-pink-400 text-white font-bold rounded-lg hover:bg-pink-500 transition duration-200 mb-3">
                                Salvar Alterações
                            </button>

                            <button type="submit" name="deletar_usuario" 
                                onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');"
                                class="w-full py-3 bg-rose-500 text-white font-bold rounded-lg hover:bg-rose-600 transition duration-200">
                                Deletar minha conta
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="mt-8 text-center">
                <a href="principal.php" class="text-yellow-500 font-semibold hover:underline">Voltar para o perfil</a>
            </div>
        </div>
    </div>

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
</body>
</html>
