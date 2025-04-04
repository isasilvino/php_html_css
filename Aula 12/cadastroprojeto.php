<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Projeto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 min-h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-xl shadow-lg max-w-lg w-full text-orange-600">
        <h1 class="text-3xl font-bold mb-6 text-center">Adicionar Projeto</h1>

        <form action="acoesprojeto.php" method="POST" enctype="multipart/form-data" class="space-y-5">
            <div>
                <label class="block mb-1 text-gray-800 font-semibold text-sm">Título do projeto</label>
                <input type="text" name="nomeprojeto" required placeholder="Ex: Meu projeto criativo" class="w-full p-3 rounded-md bg-gray-100 border border-gray-300">
            </div>

            <div>
                <label class="block mb-1 text-gray-800 font-semibold text-sm">Descrição</label>
                <textarea name="descricao" required placeholder="Fale um pouco sobre o projeto..." rows="4" class="w-full p-3 rounded-md bg-gray-100 border border-gray-300 resize-none"></textarea>
            </div>

            <div>
                <label class="block mb-1 text-gray-800 font-semibold text-sm">Imagem do projeto</label>
                <input type="file" name="imagem" accept="image/*" required class="w-full p-2 rounded-md text-gray-800 bg-gray-100 border border-gray-300">
            </div>

            <?php if (isset($_GET['mensagem'])): ?>
                <div class="bg-yellow-300 text-black text-center p-2 rounded-md">
                    <?= htmlspecialchars($_GET['mensagem']) ?>
                </div>
            <?php endif; ?>

            <div class="flex justify-center">
                <button type="submit" name="adicionar_projeto" class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition">
                    Adicionar Projeto
                </button>
            </div>
        </form>
    </div>

</body>
</html>
