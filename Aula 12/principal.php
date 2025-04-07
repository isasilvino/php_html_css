<?php
session_start();
require 'db.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
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
    <title>Perfil do usuário</title>
    <style>
        /* utilizando css dentro do html pq só utilizei pra fazer barras laterais, o restante eh utilizado tailwind 
        /*  estilização das barras laterais*/
        .sidebar {
            height: calc(100vh - 4rem);
            top: 4rem;
        }

        /* reenquadramento para outros tipos de telas */
        @media (min-width: 768px) {
            .content-with-sidebars {
                margin-left: 16rem;
                margin-right: 16rem;
            }
        }
    </style>
</head>
<!-- estilização do background -->

<body class="bg-yellow-100 min-h-screen">
    <!-- estilização da header fixa, ou seja, ela não some quando scrolla pra baixo-->
    <header class="bg-gradient-to-r from-yellow-500 via-rose-400 to-pink-600 h-16 w-full shadow-md fixed top-0 z-50">
        <div class="container mx-auto h-full px-4 flex items-center justify-between">
            <!-- "Logo" da marca, com href que reenvia o usuario ao principal.php -->
            <a href="principal.php" class="text-white text-xl font-bold">Artify</a>

            <!-- barra de pesquisa -->
            <!-- form envia os dados pro arquivo busca.php pelo metodo $GET -->
            <form action="busca.php" method="get" class="hidden md:flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2 w-1/3">
                <!-- name="q", o 'q' eh utilizado em sistemas buscas (q=query) -->
                <input type="text" name="q" placeholder="Buscar usuários..." class="bg-transparent border-none w-full text-white placeholder-white placeholder-opacity-75 focus:outline-none">
                <button type="submit" class="ml-2">
                     <!-- aqui as logos usadas são vetoriais (heroicons) e o link eh pra informar que foi feita de acordo com w3c (regras a serem seguidas pelo site) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <!-- no path ficam os comandos vetoriais -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>

            <!-- links de navegação -->
              <!-- aqui o href chama o logout.php que encerra o login do user -->
            <div class="flex items-center space-x-4">
                <a href="logout.php" class="text-white hover:text-yellow-200 transition">Sair</a>
            </div>
        </div>
    </header>

    



    <!-- conteudo principal com padding-top p compensar o header q eh fixo -->
    <div class="container mx-auto px-4 pt-20 pb-6 content-with-sidebars">
        <!-- card principal  -->
        <div class="bg-white rounded-xl shadow-xl p-8 mx-auto max-w-5xl mb-8">

            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?= $_SESSION['mensagem'] ?></span>
                </div>
                <?php unset($_SESSION['mensagem']); ?>
            <?php endif; ?>

            <!-- perfil do usuer -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8">
                <!-- foto do user -->
                <div class="w-32 h-32 bg-blue-300 rounded-full overflow-hidden flex-shrink-0">
                    <?php if (!empty($usuario['imagem'])): ?>
                        <img src="<?= htmlspecialchars($usuario['imagem']); ?>" alt="Foto de Perfil" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="flex items-center justify-center w-full h-full text-white text-xl font-bold">IMG</span>
                    <?php endif; ?>
                </div>

                <!-- infos do user -->
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

                    <!-- botoes -->
                    <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                        <a href="editarDados.php" class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition">
                            Editar perfil
                        </a>

                    </div>
                </div>
            </div>

            <!-- linha de divisao -->
            <hr class="my-8 border-gray-200">


           <!-- espaço pra projetos -->
<div class="mt-8">
    <!-- Cabeçalho com título e botão alinhados horizontalmente -->
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-orange-600">Meus projetos</h3>

        <form action="acoes.php" method="post" enctype="multipart/form-data" class="flex items-center space-x-3">
            <div class="hidden md:block">
                <input type="file" name="projetoUsuario" class="text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
            </div>
            <button type="submit" name="salvar_projeto" class="py-2 px-4 bg-pink-400 text-white font-bold rounded-lg hover:bg-pink-500 transition duration-200">
                Adicionar projeto
            </button>
        </form>
    </div>

    <!-- conteudo dos projetos -->
    <?php
    // Busca os projetos do usuário
    $query = $db->prepare('SELECT id, titulo, descricao, imagem, data_criacao FROM projetos WHERE usuario_id = (SELECT id FROM usuarios WHERE email = :email) ORDER BY data_criacao DESC');
    $query->execute(['email' => $_SESSION['email']]);
    $projetos = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // Conta os projetos
    $total_projetos = count($projetos);
    ?>
    
    <?php if (empty($projetos)): ?>
        <div class="text-center py-10 bg-gray-50 rounded-lg">
            <p class="text-gray-500">você ainda não tem projetos :(</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 bg-gray-50 rounded-lg p-4">
            <?php foreach ($projetos as $projeto): ?>
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="h-48 overflow-hidden">
                        <img src="<?= htmlspecialchars($projeto['imagem']); ?>" alt="<?= htmlspecialchars($projeto['titulo']); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-lg"><?= htmlspecialchars($projeto['titulo']); ?></h4>
                        <?php if (!empty($projeto['descricao'])): ?>
                            <p class="text-gray-600 text-sm mt-1"><?= htmlspecialchars($projeto['descricao']); ?></p>
                        <?php endif; ?>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-xs text-gray-500">
                                <?= date('d/m/Y', strtotime($projeto['data_criacao'])); ?>
                            </span>
                            
                            <form action="acoes.php" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
                                <input type="hidden" name="projeto_id" value="<?= $projeto['id'] ?>">
                                <button type="submit" name="excluir_projeto" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
 </div>

    </div>

    </div>

</body>

</html>