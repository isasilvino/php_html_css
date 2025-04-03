<?php
session_start();
require 'db.php';

$termo_busca = isset($_GET['q']) ? trim($_GET['q']) : '';
$resultados = [];

if (!empty($termo_busca)) {
    $db = db();
    
    // busca usuario pelo nome ou email
    $query = $db->prepare("
        SELECT id, nome, email, bio, imagem 
        FROM usuarios 
        WHERE nome LIKE :termo OR email LIKE :termo
        ORDER BY nome
    ");
    $query->execute(['termo' => '%' . $termo_busca . '%']);
    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Buscar Usuários</title>
</head>

<body class="bg-yellow-100 min-h-screen">
    <!-- header -->
    <header class="bg-gradient-to-r from-yellow-500 via-rose-400 to-pink-600 h-16 w-full shadow-md fixed top-0 z-50">
        <div class="container mx-auto h-full px-4 flex items-center justify-between">
            <a href="principal.php" class="text-white text-xl font-bold">Artify</a>
            
            <!-- barra de pesquisa -->
            <form action="busca.php" method="get" class="flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2 w-1/3">
                <input type="text" name="q" value="<?= htmlspecialchars($termo_busca) ?>" placeholder="Buscar usuários..." class="bg-transparent border-none w-full text-white placeholder-white placeholder-opacity-75 focus:outline-none">
                <button type="submit" class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
            
            <!-- links de nav -->
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['email'])): ?>
                    <a href="principal.php" class="text-white hover:text-yellow-200 transition">Meu Perfil</a>
                    <a href="logout.php" class="text-white hover:text-yellow-200 transition">Sair</a>
                <?php else: ?>
                    <a href="index.php" class="text-white hover:text-yellow-200 transition">Login</a>
                    <a href="cadastro.php" class="text-white hover:text-yellow-200 transition">Cadastro</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- conteudo principal -->
    <div class="container mx-auto px-4 pt-24 pb-6">
        <div class="bg-white rounded-xl shadow-xl p-8 mx-auto max-w-5xl">
            <h2 class="text-2xl font-bold text-orange-600 mb-6">
                <?php if (empty($termo_busca)): ?>
                    Buscar usuários
                <?php else: ?>
                    Resultados para "<?= htmlspecialchars($termo_busca) ?>"
                <?php endif; ?>
            </h2>

            <?php if (!empty($termo_busca) && empty($resultados)): ?>
                <div class="text-center py-10 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Nenhum usuário encontrado para "<?= htmlspecialchars($termo_busca) ?>"</p>
                </div>
            <?php elseif (!empty($resultados)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($resultados as $usuario): ?>
                        <a href="perfil.php?id=<?= $usuario['id'] ?>" class="block">
                            <div class="flex items-center p-4 border rounded-lg hover:bg-yellow-50 transition">
                                <div class="w-16 h-16 bg-blue-300 rounded-full overflow-hidden flex-shrink-0 mr-4">
                                    <?php if (!empty($usuario['imagem'])): ?>
                                        <img src="<?= htmlspecialchars($usuario['imagem']); ?>" alt="Foto de Perfil" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <span class="flex items-center justify-center w-full h-full text-white text-xl font-bold">IMG</span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-orange-600"><?= htmlspecialchars($usuario['nome']); ?></h3>
                                    <?php if (!empty($usuario['bio'])): ?>
                                        <p class="text-gray-600 text-sm truncate"><?= htmlspecialchars($usuario['bio']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-10 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Digite um nome ou email para buscar usuários</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
