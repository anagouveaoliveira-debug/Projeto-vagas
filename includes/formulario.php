<main>  

    <section class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h2 class="h4 font-weight-bold text-dark mb-1"><?=TITLE?></h2>
            <p class="text-muted small mb-0">Preencha as informações abaixo para atualizar o sistema</p>
        </div>
        <a href="index.php" class="btn btn-sm btn-outline-secondary px-3" style="border-radius: 6px;">
            Voltar para o início
        </a>
    </section>

    <div class="card bg-white shadow-sm border-0 p-4 mb-5" style="border-radius: 8px; border: 1px solid #e9ecef !important;">
        
        <form method="post">

            <div class="form-group mb-4">
                <label class="text-muted small font-weight-bold uppercase mb-2 d-block">Título do Cargo</label>
                <input type="text" class="form-control text-secondary py-4" style="border-radius: 6px; font-size: 0.95rem;" name="titulo" placeholder="Ex: Desenvolvedor Backend Pleno" value="<?=$obVaga->titulo ?? null?>" required>
            </div>

            <div class="form-group mb-4">
                <label for="descricao" class="text-muted small font-weight-bold uppercase mb-2 d-block">Descrição das Atividades</label>
                <textarea class="form-control text-secondary p-3" id="descricao" name="descricao" rows="6" style="border-radius: 6px; font-size: 0.95rem;" placeholder="Descreva detalhadamente os requisitos e as responsabilidades da vaga..." required><?=$obVaga->descricao ?? null?></textarea>
            </div>

            <div class="form-group mb-4">
                <label class="text-muted small font-weight-bold uppercase mb-2 d-block">Status da Vaga</label>

                <div class="d-flex" style="gap: 15px;">
                    
                    <div class="form-check p-0 m-0">
                        <label class="d-flex align-items-center bg-light border px-3 py-2 rounded style-pointer" style="gap: 8px; font-size: 0.9rem; cursor: pointer;">
                            <input type="radio" name="ativo" value="true" <?=isset($obVaga->ativo) && $obVaga->ativo === 'true' ? ' checked' : ''?>>
                            <span class="text-success font-weight-bold">Ativo</span>
                        </label>
                    </div>

                    <div class="form-check p-0 m-0">
                        <label class="d-flex align-items-center bg-light border px-3 py-2 rounded style-pointer" style="gap: 8px; font-size: 0.9rem; cursor: pointer;">
                            <input type="radio" name="ativo" value="false" <?=isset($obVaga->ativo) && $obVaga->ativo === 'false' ? ' chec  ked' : ''?>> 
                            <span class="text-danger font-weight-bold">Inativo</span>
                        </label>
                    </div>
                    
                </div>    
            </div>

            <hr class="my-4" style="border-top: 1px solid #f1f3f5;">

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold shadow-sm" style="font-size: 0.9rem; border-radius: 6px;">
                    Salvar Registro
                </button>
            </div>

        </form>    
    </div>

</main>