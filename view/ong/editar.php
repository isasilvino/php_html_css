<?php ob_start(); ?>

<h2 class="text-xl font-bold mb-4">Editar Animal</h2>

<form action="/atualizar-animal" method="POST" class="space-y-4">
    <input type="hidden" name="id" value="<?= $animal['id'] ?>">

    <div>
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($animal['nome']) ?>" class="border p-2 w-full">
    </div>

    <div>
        <label>Raça:</label>
        <input type="text" name="raca" value="<?= htmlspecialchars($animal['raca']) ?>" class="border p-2 w-full">
    </div>

    <div>
        <label>Idade:</label>
        <input type="text" name="idade" value="<?= htmlspecialchars($animal['idade']) ?>" class="border p-2 w-full">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
</form>

<?php
$content = ob_get_clean();
include_once __DIR__ . '/../template/app.php';
