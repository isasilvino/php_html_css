<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

include('db.php');

if (!isset($_GET['id'])) {
    header("Location: principal.php?mensagem=Projeto não encontrado!");
    exit;
}

$db = db();
$query = $db->prepare("SELECT * FROM projetos WHERE id = :id AND usuario_id = :usuario_id");
$query->execute([
    'id' => $_GET['id'],
    'usuario_id' => $_SESSION['usuario_id']
]);
$projeto = $query->fetch(PDO::FETCH_ASSOC);

if (!$projeto) {
    header("Location: principal.php?mensagem=Projeto não encontrado ou acesso negado!");
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
        <h1 class="text-3xl font-bold mb-6 text-center">Edição de projeto</h1>

        <form action="acoesprojeto.php" method="POST" enctype="multipart/form-data" class="space-y-5">
    <input type="hidden" name="id" value="<?= $projeto['id']; ?>">

    <div>
        <label class="block mb-1 text-sm">Título do projeto</label>
        <input type="text" name="nomeprojeto" required value="<?= htmlspecialchars($projeto['titulo']); ?>" class="w-full p-3 rounded-md bg-gray-100 border border-gray-300">
    </div>

    <div>
        <label class="block mb-1 text-sm">Descrição</label>
        <textarea name="descricao" required class="w-full p-3 rounded-md bg-gray-100 border border-gray-300 resize-none"><?= htmlspecialchars($projeto['descricao']); ?></textarea>
    </div>

    <div class="flex justify-center">
        <button type="submit" name="editar_projeto" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-2 rounded-lg">
            Salvar Alterações
        </button>
    </div>
</form>
    </div>

</body>
</html>
