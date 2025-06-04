<?php

// Função para abortar com erro e mensagem
function abort($code)
{
    http_response_code($code);
    require_once __DIR__ . '/view/404.php'; // exibe sua página 404 customizada
    exit;
}

// Obtém método HTTP e caminho da URL
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove o caminho base da URI se existir
$baseDir = '/ProjetoIntegrador/projeto-ongs';
if (strpos($uri, $baseDir) === 0) {
    $uri = substr($uri, strlen($baseDir));
}

// Define as rotas para GET e POST com os controllers
$routes = [
    'GET' => [
        '/' => ['controller' => 'HomeController', 'action' => 'index'],
        '/login' => ['controller' => 'AuthController', 'action' => 'login'],
        '/logout' => ['controller' => 'AuthController', 'action' => 'logout'],
        '/dashboard' => ['controller' => 'DashboardController', 'action' => 'index'],
        '/dashboard/novo' => ['controller' => 'DashboardController', 'action' => 'novoAnimal'],
        '/editar-animal' => ['controller' => 'DashboardController', 'action' => 'mostrarFormularioEdicaoAnimal'],
        '/auth/cadastro' => ['controller' => 'AuthController', 'action' => 'cadastro'],
        '/animais' => ['controller' => 'AnimalController', 'action' => 'listagemPublica'],
        '/animais/detalhes' => ['controller' => 'AnimalController', 'action' => 'detalhes'],
        '/animais/adotar' => ['controller' => 'AnimalController', 'action' => 'formularioAdocao']
    ],
    'POST' => [
        '/login' => ['controller' => 'AuthController', 'action' => 'login'],
        '/dashboard/salvar' => ['controller' => 'DashboardController', 'action' => 'salvarAnimal'],
        '/atualizar-animal' => ['controller' => 'DashboardController', 'action' => 'atualizarAnimal'],
        '/deletar-animal' => ['controller' => 'DashboardController', 'action' => 'deletarAnimal'],
        '/auth/cadastro' => ['controller' => 'AuthController', 'action' => 'cadastro'],
        '/animais/enviar-candidatura' => ['controller' => 'AnimalController', 'action' => 'enviarCandidatura']
    ]
];

// Verifica se a rota existe
if (!isset($routes[$method][$uri])) {
    abort(404);
}

// Obtém o controller e action da rota
$route = $routes[$method][$uri];
$controllerName = $route['controller'];
$actionName = $route['action'];

// Inclui o arquivo do controller
$controllerFile = __DIR__ . '/controller/' . strtolower(str_replace('Controller', '', $controllerName)) . 'Controller.php';
if (!file_exists($controllerFile)) {
    abort(404);
}

require_once $controllerFile;

// Instancia o controller e chama a action
$controller = new $controllerName();
if (!method_exists($controller, $actionName)) {
    abort(404);
}

$controller->$actionName();