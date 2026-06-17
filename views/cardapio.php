<div class="container py-5">
    <h2 class="fw-bold text-areia text-center mb-2">🍤 Cardápio da Orla</h2>
    <p class="text-dark text-center mb-5">Navegue pelas delícias dos nossos quiosques parceiros.</p>

    <?php if(isset($_SESSION['mensagem_carrinho'])): ?>
        <div class="alert alert-success fw-bold border-0 bg-success text-black text-center shadow-sm">
            <?= $_SESSION['mensagem_carrinho']; unset($_SESSION['mensagem_carrinho']); ?>
            <a href="index.php?route=carrinho" class="text-white text-decoration-underline ms-2">Ver meu carrinho</a>
        </div>
    <?php endif; ?>

    <?php if (empty($produtos_por_quiosque)): ?>
        <div class="alert alert-warning text-center">Nenhum produto disponível no momento.</div>
    <?php else: ?>
        
        <?php foreach ($produtos_por_quiosque as $quiosque => $produtos): ?>
            <div class="mt-5 mb-4 border-bottom border-secondary pb-2">
                <h3 class="fw-bold text-laranja"><i class="fs-4">🏪</i> <?= htmlspecialchars($quiosque) ?></h3>
            </div>

            <div class="row g-4">
                <?php foreach ($produtos as $p): ?>
                <div class="col-md-4">
                    <div class="card card-dark h-100 shadow-sm border-0 rounded-4 p-3">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2 align-self-start"><?= htmlspecialchars($p['categoria']) ?></span>
                            <h5 class="card-title fw-bold text-black"><?= htmlspecialchars($p['nome']) ?></h5>
                            <p class="card-text text-muted small flex-grow-1"><?= htmlspecialchars($p['descricao']) ?></p>
                            <h4 class="fw-bold text-areia my-3">R$ <?= number_format($p['preco'], 2, ',', '.') ?></h4>
                            <a href="index.php?route=carrinho&add=<?= $p['id'] ?>" class="cta-button w-100 py-2 border-0 mt-auto" style="font-size: 0.9rem;">
                                Adicionar ao Pedido
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>