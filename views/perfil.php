<div class="container py-5">
    <h2 class="fw-bold text-areia text-center mb-2">👤 O Meu Perfil</h2>
    <p class="text-light text-center mb-5">Crie a sua conta e guarde o seu endereço para agilizar os seus pedidos.</p>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-dark shadow-lg p-4 p-md-5 rounded-4 border-0">
                
                <!-- Secção: Dados Pessoais -->
                <h4 class="mb-4 fw-bold text-laranja border-bottom border-secondary pb-3">Dados Pessoais</h4>
                
                <?php if(isset($msg_perfil) && $msg_perfil): ?>
                    <!-- Alerta de Sucesso ou Erro -->
                    <div class="alert alert-<?= $msg_perfil['tipo'] ?> bg-<?= $msg_perfil['tipo'] ?> text-white border-0 fw-bold">
                        <?= $msg_perfil['msg'] ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?route=perfil">
                    <input type="hidden" name="form_cadastro" value="1">
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-areia">Nome Completo</label>
                            <input type="text" name="nome" class="form-control bg-dark text-light border-secondary" required placeholder="Ex: João Silva">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-areia">E-mail</label>
                            <input type="email" name="email" class="form-control bg-dark text-light border-secondary" required placeholder="joao@email.com">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-areia">Senha</label>
                            <input type="password" name="senha" class="form-control bg-dark text-light border-secondary" required placeholder="Crie uma Senha forte">
                        </div>
                    </div>

                    <!-- Secção: Endereço -->
                    <h4 class="mb-4 fw-bold text-laranja border-bottom border-secondary pb-3 mt-5">Endereço de Entrega</h4>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-areia">CEP / Código Postal</label>
                            <input type="text" name="cep" class="form-control bg-dark text-light border-secondary" required placeholder="00000-000">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-areia">Rua / Avenida</label>
                            <input type="text" name="rua" class="form-control bg-dark text-light border-secondary" required placeholder="Ex: Avenida Beira Mar">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-areia">Número</label>
                            <input type="text" name="numero" class="form-control bg-dark text-light border-secondary" required placeholder="Ex: 45">
                        </div>
                        
                        <div class="col-md-5">
                            <label class="form-label text-areia">Bairro</label>
                            <input type="text" name="bairro" class="form-control bg-dark text-light border-secondary" required placeholder="Ex: Praia da Costa">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label text-areia">Cidade</label>
                            <input type="text" name="cidade" class="form-control bg-dark text-light border-secondary" required placeholder="Ex: Vila Velha">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-areia">Estado</label>
                            <input type="text" name="estado" class="form-control bg-dark text-light border-secondary" required placeholder="ES">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-8">
                            <h4 class="mb-4 fw-bold text-areia border-bottom border-secondary pb-3">Histórico de Compras na Rede</h4>
                            
                            <div class="card card-dark shadow-sm rounded-4 border-0 overflow-hidden">
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover bg-transparent mb-0">
                                        <thead style="background-color: rgba(255,255,255,0.05);">
                                            <tr>
                                                <th class="text-areia px-4"># Pedido</th>
                                                <th class="text-areia">Data</th>
                                                <th class="text-areia">Total</th>
                                                <th class="text-areia">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // O ideal é que $historico_pedidos venha do seu Controller
                                            if(isset($historico_pedidos) && $historico_pedidos->rowCount() > 0): 
                                                while ($row = $historico_pedidos->fetch(PDO::FETCH_ASSOC)): 
                                            ?>
                                            <tr>
                                                <td class="text-light fw-bold px-4">BW-<?= str_pad($row['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                                <td class="text-light"><?= date('d/m/Y H:i', strtotime($row['criado_em'])) ?></td>
                                                <td class="text-light fw-bold text-laranja">R$ <?= number_format($row['valor_total'], 2, ',', '.') ?></td>
                                                <td>
                                                    <?php 
                                                        $cor_badge = $row['status_pedido'] == 'Entregue' ? 'bg-success' : 'bg-warning text-dark';
                                                    ?>
                                                    <span class="badge <?= $cor_badge ?> rounded-pill"><?= htmlspecialchars($row['status_pedido']) ?></span>
                                                </td>
                                            </tr>
                                            <?php 
                                                endwhile; 
                                            else: 
                                            ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">Você ainda não fez nenhum pedido na orla.</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="cta-button w-100 mt-3 border-0 py-3 fs-5">Criar Conta e Guardar Endereço</button>
                </form>
            </div>
        </div>
    </div>
</div>