<header class="hero-beach text-center shadow">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3 text-white">A orla nas suas mãos.</h1>
        <p class="lead fs-4 mb-4 text-white">Peça dos melhores quiosques de Vila Velha e receba direto na sua cadeira de praia.</p>
        
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap mt-4">
            <a href="index.php?route=cardapio" class="cta-button">EXPLORAR QUIOSQUES</a>
            <a href="index.php?route=reservas" class="btn-outline-custom">RESERVAR UMA MESA</a>
        </div>
    </div>
</header>

<section class="py-5 text-center" style="background-color: rgba(0,0,0,0.2);">
    <div class="container py-4">
        <h2 class="fw-bold mb-5 text-laranja">Como funciona o Beach Wings Network?</h2>
        <div class="row g-4 text-light">
            <div class="col-md-4">
                <h1 class="display-4 mb-3 text-areia">📱</h1>
                <h5 class="fw-bold">1. Escolha o Local</h5>
                <p class="text-muted">Navegue pelos quiosques parceiros espalhados pela costa.</p>
            </div>
            <div class="col-md-4">
                <h1 class="display-4 mb-3 text-areia">🍤</h1>
                <h5 class="fw-bold">2. Monte o Pedido</h5>
                <p class="text-muted">Misture petiscos de um e drinks de outro no mesmo carrinho.</p>
            </div>
            <div class="col-md-4">
                <h1 class="display-4 mb-3 text-areia">🏖️</h1>
                <h5 class="fw-bold">3. Relaxe na Areia</h5>
                <p class="text-muted">Avisamos os parceiros e a entrega é feita direto no seu guarda-sol.</p>
            </div>
        </div>
    </div>
</section>

<<section class="py-5 text-center">
    <div class="container py-4">
        <h2 class="fw-bold mb-5 text-areia">A Nossa Rede de Quiosques</h2>
        <div class="row g-4 justify-content-center">
            
            <?php 
            if(isset($quiosques_destaque) && $quiosques_destaque->rowCount() > 0): 
                // Usamos as cores do nosso tema para garantir contraste total
                // 1: Azul Mar, 2: Laranja, 3: Amarelo Areia
                $estilos_badge = [
                    ['bg' => '#2D9CDB', 'txt' => '#FFFFFF'], // Azul Mar
                    ['bg' => '#F2994A', 'txt' => '#FFFFFF'], // Laranja
                    ['bg' => '#F2C94C', 'txt' => '#1A1A1A'], // Areia (texto escuro para ler no amarelo)
                    ['bg' => '#023e8a', 'txt' => '#FFFFFF']  // Mar Profundo
                ];
                $i = 0;
                
                while ($q = $quiosques_destaque->fetch(PDO::FETCH_ASSOC)): 
                    $estilo = $estilos_badge[$i % count($estilos_badge)]; 
            ?>
            
            <div class="col-md-4">
                <div class="card card-dark h-100 shadow-lg overflow-hidden p-3 border-0 rounded-4" style="background-color: #162a4a !important;">
                    <div class="card-body d-flex flex-column text-center">
                        <div class="mb-3">
                            <span class="badge px-3 py-2 fw-bold shadow-sm" 
                                  style="background-color: <?= $estilo['bg'] ?>; color: <?= $estilo['txt'] ?>; font-size: 0.9rem;">
                                📍 <?= htmlspecialchars($q['localizacao']) ?>
                            </span>
                        </div>
                        <h4 class="fw-bold text-white mb-2"><?= htmlspecialchars($q['nome']) ?></h4>
                        <p class="small mb-4 flex-grow-1" style="color: rgba(255,255,255,0.7);">
                            <?= htmlspecialchars($q['descricao']) ?>
                        </p>
                        <a href="index.php?route=cardapio" class="cta-button w-100 mt-auto rounded-pill border-0 shadow" style="padding: 10px;">
                            Ver Cardápio
                        </a>
                    </div>
                </div>
            </div>
            
            <?php 
                    $i++;
                endwhile; 
            else: 
            ?>
                <div class="col-12">
                    <p class="text-white fs-5 opacity-50">Nenhum quiosque aberto no momento...</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
        <div class="row g-4 text-center justify-content-center">
            <div class="col-md-4">
                <div class="card card-dark h-100 shadow-sm overflow-hidden p-3 border-0 rounded-4" style