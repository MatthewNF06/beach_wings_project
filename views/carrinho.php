<h2>Seu Carrinho 🛒</h2>
<div class="card shadow-sm p-4 mt-3">
    <?php if(empty($_SESSION['carrinho'])): ?>
        <p>O seu carrinho está vazio.</p>
    <?php else: ?>
        <ul class="list-group mb-3">
            <?php 
            $total = 0;
            foreach($_SESSION['carrinho'] as $id => $qtd): 
                $prod = $produtoModel->buscarPorId($id);
                $subtotal = $prod['preco'] * $qtd;
                $total += $subtotal;
            ?>
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0"><?= $prod['nome'] ?> (x<?= $qtd ?>)</h6>
                </div>
                <span class="text-muted">R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
            </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (BRL)</span>
                <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
            </li>
        </ul>
        <form method="POST" action="index.php?route=carrinho">
            <button type="submit" name="limpar_carrinho" class="btn btn-danger">Limpar Carrinho</button>
            <button type="button" class="btn btn-success float-end">Finalizar Pedido (Breve)</button>
        </form>
    <?php endif; ?>
</div>