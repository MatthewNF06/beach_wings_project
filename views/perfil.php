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
                    
                    <button type="submit" class="cta-button w-100 mt-3 border-0 py-3 fs-5">Criar Conta e Guardar Endereço</button>
                </form>
            </div>
        </div>
    </div>
</div>