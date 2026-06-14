<?php
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_carrinho'])) {
    $id = $_POST['produto_id'];
    $_SESSION['carrinho'][$id] = isset($_SESSION['carrinho'][$id]) ? $_SESSION['carrinho'][$id] + 1 : 1;
    $msg_carrinho = "Produto adicionado ao carrinho!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['limpar_carrinho'])) {
    $_SESSION['carrinho'] = [];
}
?>