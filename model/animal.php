<?php

require_once __DIR__ . '/../database/db.php';

class Animal {
    public $id;
    public $nome;
    public $tipo;
    public $raca;
    public $idade;
    public $porte;
    public $sexo;
    public $descricao;
    public $foto;
    public $ong_id;
    public $status;
    public $ong_nome;
    public $ong_cidade;
    public $ong_estado;

    private static function getDB() {
        return Database::getInstance();
    }

    public static function findAllDisponiveis() {
        $db = self::getDB();
        try {
            error_log("Iniciando busca de animais disponíveis");
            
            $sql = "SELECT a.*, o.nome as ong_nome, o.cidade as ong_cidade, o.estado as ong_estado 
                    FROM animais a 
                    JOIN ongs o ON a.ong_id = o.id 
                    WHERE a.status = 'disponivel' 
                    ORDER BY a.created_at DESC";
            
            error_log("SQL a ser executado: " . $sql);
            
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            error_log("Número de animais encontrados: " . count($result));
            if (count($result) === 0) {
                error_log("Nenhum animal encontrado. Verificando se há animais na tabela...");
                $checkSql = "SELECT COUNT(*) FROM animais";
                $checkStmt = $db->query($checkSql);
                $totalAnimais = $checkStmt->fetchColumn();
                error_log("Total de animais na tabela: " . $totalAnimais);
                
                $checkSql = "SELECT COUNT(*) FROM ongs";
                $checkStmt = $db->query($checkSql);
                $totalOngs = $checkStmt->fetchColumn();
                error_log("Total de ONGs na tabela: " . $totalOngs);
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Erro ao buscar animais disponíveis: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            return [];
        }
    }

    public static function create($data) {
        $db = self::getDB();
        try {
            $sql = "INSERT INTO animais (nome, tipo, raca, idade, porte, sexo, descricao, foto, ong_id, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $params = [
                $data['nome'],
                $data['tipo'],
                $data['raca'],
                $data['idade'],
                $data['porte'],
                $data['sexo'],
                $data['descricao'],
                $data['foto'],
                $data['ong_id'],
                'disponivel'
            ];

            $db->query($sql, $params);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar animal: " . $e->getMessage());
            return false;
        }
    }

    public static function findByOng($ong_id) {
        $db = self::getDB();
        try {
            $stmt = $db->query("SELECT * FROM animais WHERE ong_id = ? ORDER BY id DESC", [$ong_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar animais: " . $e->getMessage());
            return [];
        }
    }

    public static function findById($id) {
        $db = self::getDB();
        try {
            $sql = "SELECT a.*, o.nome as ong_nome, o.cidade as ong_cidade, o.estado as ong_estado 
                    FROM animais a 
                    JOIN ongs o ON a.ong_id = o.id 
                    WHERE a.id = ? 
                    LIMIT 1";
            
            $stmt = $db->query($sql, [$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                return self::createFromArray($data);
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erro ao buscar animal: " . $e->getMessage());
            return null;
        }
    }

    private static function createFromArray($array) {
        $animal = new self();
        $animal->id = $array['id'];
        $animal->nome = $array['nome'];
        $animal->tipo = $array['tipo'];
        $animal->raca = $array['raca'];
        $animal->idade = $array['idade'];
        $animal->porte = $array['porte'];
        $animal->sexo = $array['sexo'];
        $animal->descricao = $array['descricao'];
        $animal->foto = $array['foto'];
        $animal->ong_id = $array['ong_id'];
        $animal->status = $array['status'];
        $animal->ong_nome = $array['ong_nome'] ?? null;
        $animal->ong_cidade = $array['ong_cidade'] ?? null;
        $animal->ong_estado = $array['ong_estado'] ?? null;
        return $animal;
    }
}


