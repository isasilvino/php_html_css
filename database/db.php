<?php

class Database {
    private static $instance = null;
    private $conn = null;
    private $config = [];

    private function __construct() {
        // Carrega as configurações
        require_once __DIR__ . '/config.php';
        
        $this->config = [
            'host' => DB_HOST,
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'charset' => DB_CHARSET
        ];
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        if ($this->conn === null) {
            $this->connect();
        }
        return $this->conn;
    }

    private function connect() {
        try {
            if (empty($this->config)) {
                throw new Exception("Configurações do banco de dados não foram carregadas corretamente");
            }

            error_log("Tentando conectar ao banco de dados: " . $this->config['dbname']);

            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s",
                $this->config['host'],
                $this->config['dbname'],
                $this->config['charset']
            );
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $this->conn = new PDO($dsn, $this->config['user'], $this->config['pass'], $options);
            error_log("Conexão estabelecida com sucesso!");
        } catch(PDOException $e) {
            error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        } catch(Exception $e) {
            error_log("Erro de configuração: " . $e->getMessage());
            die("Erro de configuração: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        if ($this->conn === null) {
            $this->connect();
        }

        try {
            error_log("Executando query: " . $sql);
            if (!empty($params)) {
                error_log("Parâmetros: " . print_r($params, true));
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            error_log("Erro na query: " . $e->getMessage());
            throw $e;
        }
    }
}

?>