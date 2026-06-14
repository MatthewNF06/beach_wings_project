<?php
session_start(); // Inicia a sessão para o carrinho e login

require_once 'config/Database.php';

$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Carrega o cabeçalho padrão
require_once 'views/includes/header.php';

// Controlador Frontal (Router)
switch ($route) {
    case 'reservas':
        require_once 'controllers/ReservaController.php';
        require_once 'views/reserva.php';
        break;
    case 'cardapio':
        require_once 'controllers/ProdutoController.php';
        require_once 'controllers/CarrinhoController.php';
        require_once 'views/cardapio.php';
        break;
    case 'carrinho':
        require_once 'controllers/CarrinhoController.php';
        require_once 'controllers/ProdutoController.php';
        require_once 'views/carrinho.php';
        break;
    case 'perfil':
        require_once 'controllers/UsuarioController.php';
        require_once 'views/perfil.php';
        break;
    case 'home':
    default:
        require_once 'views/home.php';
        break;
}

// Carrega o rodapé padrão
require_once 'views/includes/footer.php';
?>