<main>
    <h2 class="mt-3">Inativar Vaga</h2>
    <p>Você está inativando a vaga: <strong><?=$obVaga->titulo?></strong></p>

    <form method="post">
        
        <div class="form-group mb-3">
            <label for="motivo_inativacao" class="fw-bold">Por favor, informe o motivo da inativação:</label>
            <textarea class="form-control" name="motivo_inativacao" id="motivo_inativacao" rows="4" required placeholder="Ex: Vaga preenchida, cancelada pelo cliente..."></textarea>
        </div>

        <div class="form-group">
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" name="confirmar" class="btn btn-warning">Confirmar Inativação</button>
        </div>

    </form>
</main>

