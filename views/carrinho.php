<div class="container py-5">
    <h2 class="fw-bold text-areia text-center mb-2">O Seu Carrinho</h2>
    <p class="text-dark text-center mb-5">Revise os seus itens antes de enviarmos para os quiosques.</p>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <?php if(isset($_SESSION['mensagem_carrinho'])): ?>
                <div class="alert alert-success fw-bold border-0 bg-success text-white">
                    <?= $_SESSION['mensagem_carrinho']; unset($_SESSION['mensagem_carrinho']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['erro_carrinho'])): ?>
                <div class="alert alert-danger fw-bold border-0 bg-danger text-white">
                    <?= $_SESSION['erro_carrinho']; unset($_SESSION['erro_carrinho']); ?>
                </div>
            <?php endif; ?>

            <div class="card card-dark shadow-lg rounded-4 border-0 p-4">
                <?php if (empty($_SESSION['carrinho'])): ?>
                    <div class="text-center py-5">
                        <h1 class="display-1 text-muted mb-3">🏖️</h1>
                        <h4 class="text-light">O seu carrinho está vazio!</h4>
                        <p class="text-muted">A praia está cheia de opções deliciosas esperando por si.</p>
                        <a href="index.php?route=cardapio" class="cta-button mt-3 border-0">Explorar Quiosques</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover bg-transparent align-middle">
                            <thead style="background-color: rgba(255,255,255,0.05);">
                                <tr>
                                    <th class="text-areia">Produto</th>
                                    <th class="text-areia text-center">Qtd</th>
                                    <th class="text-areia text-end">Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                foreach ($_SESSION['carrinho'] as $id => $item): 
                                    $subtotal = $item['preco'] * $item['quantidade'];
                                    $total += $subtotal;
                                ?>
                                <tr>
                                    <td class="text-light fw-bold"><?= htmlspecialchars($item['nome']) ?></td>
                                    <td class="text-center text-light"><?= $item['quantidade'] ?></td>
                                    <td class="text-end text-laranja fw-bold">R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end text-areia fw-bold fs-5 pt-4">Total da Compra:</td>
                                    <td class="text-end text-laranja fw-bold fs-4 pt-4">R$ <?= number_format($total, 2, ',', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4 border-top border-secondary pt-4 flex-wrap gap-3">
                        <a href="index.php?route=cardapio" class="cta-button border-0 px-5 py-2">
                            Continuar Comprando
                        </a>
                        
                        <a href="index.php?route=carrinho&acao=finalizar" class="cta-button border-0 px-5 py-2">
                            Finalizar Pedido
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>