<h2>Nosso Cardápio 🍤</h2>
<?php if(isset($msg_carrinho)) echo "<div class='alert alert-success'>$msg_carrinho</div>"; ?>
<div class="row mt-4">
    <?php while ($row = $produtos->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <span class="badge bg-info mb-2"><?= $row['categoria'] ?></span>
                    <h5 class="card-title"><?= $row['nome'] ?></h5>
                    <p class="card-text text-muted small"><?= $row['descricao'] ?></p>
                    <h6 class="text-success fw-bold">R$ <?= number_format($row['preco'], 2, ',', '.') ?></h6>
                    <form method="POST" action="index.php?route=cardapio">
                        <input type="hidden" name="produto_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="add_carrinho" class="btn btn-warning w-100 mt-2">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>