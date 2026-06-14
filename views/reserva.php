<h2>📅 Reservas</h2>
<p class="text-muted">Garanta a sua mesa no Beach Wings com vista para o mar.</p>

<div class="row mt-4">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Faça a sua Reserva</h4>
            
            <?php if(isset($mensagem) && $mensagem): ?>
                <div class="alert alert-<?= $mensagem['tipo'] ?>"><?= $mensagem['msg'] ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?route=reservas">
                <input type="hidden" name="form_reserva" value="1"> 
                
                <div class="mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="nome_cliente" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" name="data_reserva" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pessoas</label>
                        <input type="number" name="numero_pessoas" class="form-control" min="1" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning w-100 mt-2 fw-bold">Confirmar Mesa</button>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <h4 class="mb-3">Próximas Reservas</h4>
        <div class="table-responsive">
            <table class="table table-hover bg-white shadow-sm rounded">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Pessoas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($reservas)): while ($row = $reservas->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nome_cliente']) ?></td>
                        <td><?= date('d/m/Y', strtotime($row['data_reserva'])) ?></td>
                        <td><?= htmlspecialchars($row['numero_pessoas']) ?></td>
                    </tr>
                    <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>