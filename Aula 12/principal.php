<?php

if (!isset($_SESSION)) {
    session_start();
}
include('db.php');




$db = db();
$query = $db->prepare('SELECT nome, email, localizacao, website, bio, imagem FROM usuarios WHERE email = :email');
$query->execute(['email' => $_SESSION['email']]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Erro ao carregar dados do usuário";
    
}

// busca os projetos
$projetosQuery = $db->prepare("SELECT id, titulo, descricao, imagem FROM projetos WHERE usuario_id = (SELECT id FROM usuarios WHERE email = :email)");

$projetosQuery->execute(['email' => $_SESSION['email']]);
$listaProjetos = $projetosQuery->fetchAll(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Erro ao carregar dados do projeto";
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Perfil do usuário</title>
    <style>
        .sidebar {
            height: calc(100vh - 4rem);
            top: 4rem;
        }

        @media (min-width: 768px) {
            .content-with-sidebars {
                margin-left: 16rem;
                margin-right: 16rem;
            }
        }
    </style>
</head>

<body class="bg-yellow-100 min-h-screen">
    <header class="bg-gradient-to-r from-yellow-500 via-rose-400 to-pink-600 h-16 w-full shadow-md fixed top-0 z-50">
        <div class="container mx-auto h-full px-4 flex items-center justify-between">
            <a href="principal.php" class="text-white text-xl font-bold">Artify</a>

            <form action="busca.php" method="get" class="hidden md:flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2 w-1/3">
                <input type="text" name="q" placeholder="Buscar usuários..." class="bg-transparent border-none w-full text-white placeholder-white placeholder-opacity-75 focus:outline-none">
                <button type="submit" class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>

            <div class="flex items-center space-x-4">
                <a href="logout.php" class="text-white hover:text-yellow-200 transition">Sair</a>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 pt-20 pb-6 content-with-sidebars">
        <div class="bg-white rounded-xl shadow-xl p-8 mx-auto max-w-5xl mb-8">

            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?= $_SESSION['mensagem'] ?></span>
                </div>
                <?php unset($_SESSION['mensagem']); ?>
            <?php endif; ?>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8">
                <div class="w-32 h-32 bg-blue-300 rounded-full overflow-hidden flex-shrink-0">
                    <?php if (!empty($usuario['imagem'])): ?>
                        <img src="<?= htmlspecialchars($usuario['imagem']); ?>" alt="Foto de Perfil" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="flex items-center justify-center w-full h-full text-white text-xl font-bold">IMG</span>
                    <?php endif; ?>
                </div>

                <div class="flex-grow text-center md:text-left">
                    <h2 class="text-2xl font-bold text-orange-600"><?php echo htmlspecialchars($usuario['nome']); ?></h2>

                    <?php if (!empty($usuario['bio'])): ?>
                        <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($usuario['bio']); ?></p>
                    <?php endif; ?>

                    <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-3">
                        <?php if (!empty($usuario['localizacao'])): ?>
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm"><?php echo htmlspecialchars($usuario['localizacao']); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($usuario['website'])): ?>
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                                <a href="<?php echo htmlspecialchars($usuario['website']); ?>" target="_blank" class="text-sm text-pink-500 hover:underline"><?php echo htmlspecialchars($usuario['website']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                        <a href="editarDados.php" class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition">
                            Editar perfil
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-200">

            <div class="mt-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-orange-600">Meus projetos</h3>
        <a href="cadastroprojeto.php" class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition">
            + Novo projeto
        </a>
    </div>

    <!-- Grid de Projetos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($listaProjetos as $projeto): ?>
            <div class="bg-white p-5 rounded-xl shadow-lg flex flex-col w-full">
                <h4 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($projeto['titulo'] ?? '') ?></h4>
                <p class="text-gray-600 mt-1 flex-grow"><?= htmlspecialchars($projeto['descricao'] ?? '') ?></p>

                <?php if (!empty($projeto['imagem'])): ?>
                    <img src="<?= htmlspecialchars($projeto['imagem']) ?>" alt="Imagem do Projeto" class="mt-2 rounded-lg h-48 w-full object-cover">
                <?php endif; ?>

                <div class="flex justify-between mt-4">
                    <form action="acoesprojeto.php" method="POST">
                        <input type="hidden" name="id" value="<?= $projeto['id']; ?>">
                        <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario_id']; ?>">
                        <button type="submit" name="deletar_projeto" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition w-24">
                            Deletar
                        </button>
                    </form>

                    <a href="editarProjeto.php?id=<?= $projeto['id']; ?>" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition w-24 text-center">
                        Editar
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    </div>
</body>

</html>