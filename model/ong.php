<?php

require_once __DIR__ . '/../database/db.php';

class Ong {
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;
    public $endereco;
    public $cidade;
    public $estado;
    public $descricao;

    private static function getDB() {
        return Database::getInstance();
    }
public static function findByEmail($email) {
    try {
        $db = Database::getInstance()->getConnection(); // PDO aqui

        $stmt = $db->prepare("SELECT * FROM ongs WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return self::createFromArray($row);
        }
        return null;
    } catch (PDOException $e) {
        error_log("Erro ao buscar ONG por email: " . $e->getMessage());
        return null;
    }
}


    public static function existsEmail($email) {
    try {
        $db = Database::getInstance()->getConnection(); // PDO aqui

        $stmt = $db->prepare("SELECT COUNT(*) FROM ongs WHERE email = ?");
        $stmt->execute([$email]);
        
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Erro ao verificar email existente: " . $e->getMessage());
        return false;
    }
}

public function cadastro() {
    if (!$this->validarDados()) {
        return false;
    }

    $db = Database::getInstance()->getConnection(); // PDO aqui
    try {
        $sql = "INSERT INTO ongs (nome, email, senha, telefone, endereco, cidade, estado, descricao) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Verifica se a senha já está hasheada
        if (!$this->isSenhaHasheada($this->senha)) {
            $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        }

        $params = [
            $this->nome,
            $this->email,
            $this->senha,
            $this->telefone,
            $this->endereco,
            $this->cidade,
            $this->estado,
            $this->descricao
        ];

        $stmt = $db->prepare($sql);   // ← prepara a query
        $stmt->execute($params);      // ← executa com os parâmetros

        return true;
    } catch (PDOException $e) {
        error_log("Erro ao cadastrar ONG: " . $e->getMessage());
        return false;
    }
}


    private function validarDados() {
        if (empty($this->nome) || empty($this->email) || empty($this->senha)) {
            error_log("Dados obrigatórios faltando no cadastro da ONG");
            return false;
        }
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            error_log("Email inválido no cadastro da ONG");
            return false;
        }

        return true;
    }

    private function isSenhaHasheada($senha) {
        return strlen($senha) === 60 && preg_match('/^\$2[ayb]\$.{56}$/', $senha);
    }

    private static function createFromArray($array) {
        $ong = new self();
        $ong->id = $array['id'];
        $ong->nome = $array['nome'];
        $ong->email = $array['email'];
        $ong->senha = $array['senha'];
        $ong->telefone = $array['telefone'] ?? null;
        $ong->endereco = $array['endereco'] ?? null;
        $ong->cidade = $array['cidade'] ?? null;
        $ong->estado = $array['estado'] ?? null;
        $ong->descricao = $array['descricao'] ?? null;
        return $ong;
    }
}
