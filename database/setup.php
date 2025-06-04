<?php

try {
    // Primeiro, conecta sem selecionar um banco de dados
    $pdo = new PDO(
        "mysql:host=localhost",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Lê e executa o arquivo schema.sql
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    
    // Executa cada comando SQL separadamente
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
        }
    }

    echo "Banco de dados e tabelas criados com sucesso!\n";
} catch (PDOException $e) {
    die("Erro na configuração do banco de dados: " . $e->getMessage() . "\n");
} 