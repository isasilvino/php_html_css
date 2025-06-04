<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Adote Mais</title>
    <!-- Importa o Tailwind via CDN para estilização simples -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-blue-600 text-white p-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-xl font-bold">Adote Mais - ONG</h1>
        </div>
    </header>

    <main class="flex-grow max-w-4xl mx-auto p-4">
        <!-- Aqui será injetado o conteúdo da view -->
        <?php
        // Tudo que for colocado na view principal será exibido aqui.
        if (isset($content)) {
            echo $content;
        }
        ?>
    </main>

    <footer class="bg-gray-300 text-center text-sm p-2">
        &copy; 2025 Adote Mais. Todos os direitos reservados.
    </footer>

</body>
</html>