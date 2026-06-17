<?php
// Inicia a sessão de forma segura
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/Database.php';

$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Controlador Frontal (Router) - Ele APENAS chama o Controller correspondente
switch ($route) {
    case 'reservas':
        require_once 'controllers/ReservaController.php';
        break;
        
    case 'cardapio':
        require_once 'controllers/CardapioController.php';
        break;
        
    case 'carrinho':
        require_once 'controllers/CarrinhoController.php';
        break;
        
    case 'perfil':
        require_once 'controllers/UsuarioController.php';
        break;
        
    case 'home':
    default:
        // Agora sim! Chama o controlador que vai buscar os dados ao banco
        require_once 'controllers/HomeController.php';
        break;
}
?>