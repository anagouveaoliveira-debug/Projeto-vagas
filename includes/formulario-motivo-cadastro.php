<main>
    <div class="card mt-4 border-warning">
        <div class="card-header bg-warning text-dark fw-bold">
            Atenção: Justificativa de Inativação Obrigatória
        </div>
        <div class="card-body">
            <h5 class="card-title">Você está criando a vaga: <strong><?=$_SESSION['vaga_rascunho']['titulo']?></strong></h5>
            <p class="card-text text-muted">Como você marcou o status como <strong>Inativo</strong>, o sistema exige que você informe o motivo antes de salvar.</p>

            <form method="post">
                
                <div class="form-group mb-3">
                    <label for="motivo_inativacao" class="fw-bold text-danger mb-2">Motivo da vaga já nascer inativa:</label>
                    <textarea 
                        class="form-control" 
                        name="motivo_inativacao" 
                        id="motivo_inativacao" 
                        rows="4" 
                        required 
                        placeholder="Ex: Vaga preenchida por processo externo, erro de duplicidade, cadastro histórico..."></textarea>
                </div>

                <div class="form-group">
                    <a href="cadastrar.php" class="btn btn-secondary">Voltar/Cancelar</a>
                    <button type="submit" class="btn btn-warning fw-bold">Confirmar e Finalizar Cadastro</button>
                </div>

            </form>
        </div>
    </div>
</main>
