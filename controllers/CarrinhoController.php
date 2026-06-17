<?php
// 1. Inicia a sessão de forma segura
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Importa as dependências necessárias
require_once 'config/Database.php';
require_once 'models/Pedido.php';
require_once 'models/Produto.php'; // Faltava isto para buscar o preço e nome!

$database = new Database();
$db = $database->getConnection();

// Garante que o array do carrinho existe na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// ==========================================
// AÇÃO 1: ADICIONAR PRODUTO AO CARRINHO
// ==========================================
if (isset($_GET['add'])) {
    $produto_id = (int) $_GET['add'];
    
    // Vai ao banco buscar as informações do produto que o cliente clicou
    $produtoModel = new Produto($db);
    $produto = $produtoModel->buscarPorId($produto_id);
    
    if ($produto) {
        // Se o produto já está no carrinho, só aumenta a quantidade
        if (isset($_SESSION['carrinho'][$produto_id])) {
            $_SESSION['carrinho'][$produto_id]['quantidade'] += 1;
        } else {
            // Se é novo, cria a estrutura dele
            $_SESSION['carrinho'][$produto_id] = [
                'produto_id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1
            ];
        }
        $_SESSION['mensagem_carrinho'] = "Aí sim! Produto adicionado ao seu carrinho.";
    }
    
    // Redireciona de volta para o cardápio para o cliente continuar a comprar
    header("Location: index.php?route=cardapio");
    exit;
}

// ==========================================
// AÇÃO 2: FINALIZAR O PEDIDO
// ==========================================
if (isset($_GET['acao']) && $_GET['acao'] == 'finalizar') {
    $usuario_logado_id = $_SESSION['usuario_id'] ?? 1; 

    if (!empty($_SESSION['carrinho'])) {
        $pedidoModel = new Pedido($db);
        $pedidoModel->usuario_id = $usuario_logado_id;
        
        // Calcula o valor total
        $total = 0;
        foreach ($_SESSION['carrinho'] as $item) {
            $total += ($item['preco'] * $item['quantidade']);
        }
        $pedidoModel->valor_total = $total;
        $pedidoModel->itens = $_SESSION['carrinho'];

        if ($pedidoModel->finalizarPedido()) {
            // Esvazia o carrinho e redireciona
            unset($_SESSION['carrinho']);
            $_SESSION['mensagem_carrinho'] = "Pedido finalizado com sucesso! A orla já está a preparar o seu pedido.";
            header("Location: index.php?route=perfil");
            exit;
        } else {
            $_SESSION['erro_carrinho'] = "Erro ao processar o pedido. Tente novamente.";
            header("Location: index.php?route=carrinho");
            exit;
        }
    }
}

// ==========================================
// CARREGAMENTO DA VIEW
// ==========================================
require_once 'views/includes/header.php';
require_once 'views/carrinho.php';
require_once 'views/includes/footer.php';
?>