<?php
require_once __DIR__ . '/../model/ong.php';
require_once __DIR__ . '/../functions.php';

class AuthController {
    private $baseUrl = '/ProjetoIntegrador/projeto-ongs';

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $senha = trim($_POST['senha']);

            $ong = Ong::findByEmail($email);

            if ($ong && password_verify($senha, $ong->senha)) {
                $_SESSION['ong_id'] = $ong->id;
                $_SESSION['ong_nome'] = $ong->nome;
                redirectWithSuccess($this->baseUrl . '/dashboard', 'Bem-vindo(a) ' . $ong->nome . '!');
            } else {
                redirectWithError($this->baseUrl . '/login', 'Email ou senha inválidos.');
            }
        } else {
            require __DIR__ . '/../view/auth/login.php';
        }
    }

    public function cadastro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = sanitizeInput($_POST['nome']);
            $email = sanitizeInput($_POST['email']);
            $senha = $_POST['senha'];
            $telefone = sanitizeInput($_POST['telefone']);
            $endereco = sanitizeInput($_POST['endereco']);
            $cidade = sanitizeInput($_POST['cidade']);
            $estado = sanitizeInput($_POST['estado']);
            $descricao = sanitizeInput($_POST['descricao']);

            if (Ong::existsEmail($email)) {
                redirectWithError($this->baseUrl . '/auth/cadastro', 'Este email já está cadastrado.');
            }

            $ong = new Ong();
            $ong->nome = $nome;
            $ong->email = $email;
            $ong->senha = password_hash($senha, PASSWORD_DEFAULT);
            $ong->telefone = $telefone;
            $ong->endereco = $endereco;
            $ong->cidade = $cidade;
            $ong->estado = $estado;
            $ong->descricao = $descricao;

            if ($ong->cadastro()) {
                redirectWithSuccess($this->baseUrl . '/login', 'Cadastro realizado com sucesso! Faça login para continuar.');
            } else {
                redirectWithError($this->baseUrl . '/auth/cadastro', 'Erro ao cadastrar, tente novamente.');
            }
        } else {
            require __DIR__ . '/../view/auth/cadastro.php';
        }
    }

    public function logout() {
        // Limpa todas as variáveis da sessão
        $_SESSION = array();

        // Destrói o cookie da sessão
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }

        // Destrói a sessão
        session_destroy();

        // Redireciona para a página inicial com mensagem de sucesso
        redirectWithSuccess($this->baseUrl . '/', 'Você saiu do sistema com sucesso!');
    }
}
