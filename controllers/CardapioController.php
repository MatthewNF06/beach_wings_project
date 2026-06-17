<?php
require_once 'models/Produto.php';
$database = new Database();
$produtoModel = new Produto($database->getConnection());

// Busca todos os produtos com o JOIN (que traz o nome do quiosque)
$produtos_db = $produtoModel->lerTodos();

// Agrupa os produtos por quiosque para facilitar a exibição na View
$produtos_por_quiosque = [];
if ($produtos_db) {
    while ($row = $produtos_db->fetch(PDO::FETCH_ASSOC)) {
        $nome_quiosque = $row['nome_quiosque'] ?? 'Quiosques Diversos';
        $produtos_por_quiosque[$nome_quiosque][] = $row;
    }
}

require_once 'views/includes/header.php';
require_once 'views/cardapio.php';
require_once 'views/includes/footer.php';
?>