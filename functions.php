<?php

/**
 * Redireciona com mensagem de erro
 */
function redirectWithError($path, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['error'] = $message;
    header("Location: " . $path);
    exit();
}

/**
 * Redireciona com mensagem de sucesso
 */
function redirectWithSuccess($path, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['success'] = $message;
    header("Location: " . $path);
    exit();
}

/**
 * Verifica se o usuário está logado
 */
function checkAuth() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['ong_id'])) {
        redirectWithError('/ProjetoIntegrador/projeto-ongs/login', 'Você precisa estar logado para acessar esta página.');
    }
}

/**
 * Limpa string de entrada
 */
function sanitizeInput($input) {
    if (is_null($input)) {
        return '';
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
