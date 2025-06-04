<?php
// Configurações de erro (apenas em desenvolvimento)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define o timezone
date_default_timezone_set('America/Sao_Paulo');

// Inicia a sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carrega os arquivos necessários
require_once __DIR__ . '/database/db.php';
require_once __DIR__ . '/functions.php';

// Carrega o arquivo de rotas
require_once __DIR__ . '/routes.php';