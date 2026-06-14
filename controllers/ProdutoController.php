<?php
require_once 'models/Produto.php';
$database = new Database();
$produtoModel = new Produto($database->getConnection());
$produtos = $produtoModel->lerTodos();
?>