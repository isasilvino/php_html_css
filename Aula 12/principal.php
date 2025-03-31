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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Perfil do usuario</title>
</head>

<body class="bg-gradient-to-b from-blue-100 to-green-100 min-h-screen flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-lg">

        <!-- cabeçalho -->
        <div class="flex items-center space-x-4">

            <!-- foto do user -->
            <div class="w-20 h-20 bg-blue-300 rounded-full overflow-hidden">
                <?php if (!empty($usuario['foto_perfil'])) { ?>
                    <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de Perfil" class="w-full h-full object-cover">
                <?php } else { ?>
                    <span class="flex items-center justify-center w-full h-full text-white text-xl font-bold">IMG</span>
                <?php } ?>
            </div>

            <!-- infos do usuário -->
            <div>
                <h2 class="text-2xl font-bold text-blue-800"><?php echo htmlspecialchars($usuario['nome']); ?></h2>
                <div class="mt-2">

                    <?php if (!empty($usuario['bio'])): ?>
                        <p class="text-gray-700 mt-2"> <?php echo htmlspecialchars($usuario['bio']); ?></p>
                    <?php endif; ?>
                </div>


                <div class="flex flex-wrap space-x-4 mt-2">
                    <?php if (!empty($usuario['localizacao'])): ?>
                        <p class="text-sm text-gray-700"><?php echo htmlspecialchars($usuario['localizacao']); ?></p>
                    <?php endif; ?>



                    <?php if (!empty($usuario['website'])): ?>
                        <p class="text-sm text-gray-700"> <?php echo htmlspecialchars($usuario['website']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>



        



        <!-- botões -->
        <div class="mt-6 flex justify-between">
            <a href="editarDados.php" class="px-4 py-2 bg-lime-500 text-white rounded hover:bg-lime-600 transition">Editar dados</a>
            <a href="logout.php" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600 transition">Sair</a>





        </div>
    </div>
</body>

</html>