<?php
// Inclui a conexão com o banco
require_once __DIR__ . '/database/db.php';

try {
    // Prepara o insert com valores fixos de teste
    $stmt = $pdo->prepare("INSERT INTO ongs (nome, email, senha, telefone, endereco, cidade, estado, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Valores de teste
    $nome = 'Teste ONG';
    $email = 'teste@teste.com';
    $senha = password_hash('123456', PASSWORD_DEFAULT);
    $telefone = '999999999';
    $endereco = 'Rua X';
    $cidade = 'Cidade Y';
    $estado = 'rs';
    $descricao = 'Descrição teste';

    $result = $stmt->execute([$nome, $email, $senha, $telefone, $endereco, $cidade, $estado, $descricao]);

    if ($result) {
        echo "Inserido com sucesso!";
    } else {
        echo "Falha no insert!";
    }
} catch (PDOException $e) {
    echo "Erro ao inserir: " . $e->getMessage();
}
