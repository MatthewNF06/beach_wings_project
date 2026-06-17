<div class="container py-5">
    <h2 class="fw-bold text-areia text-center mb-2">📅 Reservas na Orla</h2>
    <p class="text-light text-center mb-5">Escolha o seu quiosque favorito e garanta a sua mesa com vista para o mar.</p>

    <div class="row mt-4">
        <div class="col-md-5 mb-4">
            <div class="card card-dark shadow-sm p-4 rounded-4 border-0">
                <h4 class="mb-4 text-laranja fw-bold border-bottom border-secondary pb-2">Faça a sua Reserva</h4>
                
                <?php if(isset($mensagem) && $mensagem): ?>
                    <div class="alert alert-<?= $mensagem['tipo'] ?> bg-<?= $mensagem['tipo'] ?> text-white border-0 fw-bold"><?= $mensagem['msg'] ?></div>
                <?php endif; ?>

                <form method="POST" action="index.php?route=reservas">
                    <input type="hidden" name="form_reserva" value="1"> 
                    
                    <div class="mb-3">
                        <label class="form-label text-areia">Escolha o Quiosque</label>
                        <select name="quiosque_id" class="form-select bg-dark text-light border-secondary" required>
                            <option value="">Selecione um local...</option>
                            <?php if($lista_quiosques): while($q = $lista_quiosques->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $q['id'] ?>"><?= htmlspecialchars($q['nome']) ?> (<?= htmlspecialchars($q['localizacao']) ?>)</option>
                            <?php endwhile; endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-areia">Nome Completo</label>
                        <input type="text" name="nome_cliente" class="form-control bg-dark text-light border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-areia">E-mail</label>
                        <input type="email" name="email" class="form-control bg-dark text-light border-secondary" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-areia">Data</label>
                            <input type="date" name="data_reserva" class="form-control bg-dark text-light border-secondary" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-areia">Pessoas</label>
                            <input type="number" name="numero_pessoas" class="form-control bg-dark text-light border-secondary" min="1" required>
                        </div>
                    </div>
                    <button type="submit" class="cta-button w-100 mt-3 border-0 py-2 fs-5">Confirmar Mesa</button>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <h4 class="mb-4 text-laranja fw-bold border-bottom border-secondary pb-2">Mesas Reservadas na Rede</h4>
            <div class="table-responsive">
                <table class="table table-dark table-hover bg-transparent shadow-sm rounded-4 overflow-hidden">
                    <thead style="background-color: rgba(255,255,255,0.1);">
                        <tr>
                            <th class="text-areia">Quiosque</th>
                            <th class="text-areia">Nome</th>
                            <th class="text-areia">Data</th>
                            <th class="text-areia">Pessoas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($reservas)): while ($row = $reservas->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td class="text-light fw-bold"><?= htmlspecialchars($row['nome_quiosque']) ?></td>
                            <td class="text-light"><?= htmlspecialchars($row['nome_cliente']) ?></td>
                            <td class="text-light"><?= date('d/m/Y', strtotime($row['data_reserva'])) ?></td>
                            <td class="text-light"><?= htmlspecialchars($row['numero_pessoas']) ?></td>
                        </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>