<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beach Wings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<!-- Removemos a classe bg-light daqui para o CSS do Dark Mode funcionar -->
<body>

<!-- Navbar com o fundo Azul Profundo e uma linha subtil a dividir -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #0B1D3A; border-bottom: 1px solid rgba(255,255,255,0.05);">
    <div class="container">
        <a class="navbar-brand fw-bold text-areia" href="index.php?route=home">🌴 Beach Wings</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-bold">
                <li class="nav-item"><a class="nav-link text-white" href="index.php?route=cardapio">Cardápio</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="index.php?route=reservas">Reservas</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="index.php?route=carrinho">Carrinho (<?= array_sum($_SESSION['carrinho'] ?? []) ?>)</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="index.php?route=perfil">Perfil</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Início do Container Principal que envolve as páginas -->
<div class="container-fluid p-0">