<?php
// Começamos a captura do buffer para guardar o conteúdo da view
ob_start();
?>
<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Login ONG</h1>

    <?php if (!empty($error)): ?>
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/ProjetoIntegrador/projeto-ongs/login">
        <label class="block mb-2" for="email">Email:</label>
        <input class="w-full p-2 border rounded mb-4" type="email" name="email" id="email" required>

        <label class="block mb-2" for="senha">Senha:</label>
        <input class="w-full p-2 border rounded mb-6" type="password" name="senha" id="senha" required>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700" type="submit">Entrar</button>
    </form>

    <p class="mt-4 text-center">
        Não tem cadastro? <a class="text-blue-600 hover:underline" href="/ProjetoIntegrador/projeto-ongs/auth/cadastro">Crie sua conta</a>
    </p>

    <div class="mt-4 text-center">
        <a href="/" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
            Voltar para a Home
        </a>
    </div>
</div>
<?php
// Guarda o conteúdo gerado no buffer em $content
$content = ob_get_clean();
// Inclui o template principal que vai exibir o conteúdo dentro do layout
include_once __DIR__ . '/../template/app.php';
?>
