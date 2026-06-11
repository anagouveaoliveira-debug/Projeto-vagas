
<?php

// =========================================================================
// 1. GERENCIAMENTO DE MENSAGENS E ALERTAS (Estilo de Notificação Discreta)
// =========================================================================
$mensagem = '';

if (isset($_GET['status'])){
    switch ($_GET['status']){
        case 'success':
            // "alert-success": fundo verde claro. "border-0 shadow-sm": remove bordas brutas e põe sombra leve.
            $mensagem = '<div class="alert alert-success border-0 shadow-sm small font-weight-bold py-2 mb-3">Ação executada com sucesso!</div>';
            break;
            
        case 'error':
            $mensagem = '<div class="alert alert-danger border-0 shadow-sm small font-weight-bold py-2 mb-3">Ação não executada!</div>';
            break;
            
        case 'vaga_ativa':
            $mensagem = '<div class="alert alert-warning border-0 shadow-sm small font-weight-bold py-2 mb-3">Uma vaga ativa não pode ser arquivada. Favor inativar e informar o motivo!</div>';
            break;

        case 'sem_motivo':
            $mensagem = '<div class="alert alert-warning border-0 shadow-sm small font-weight-bold py-2 mb-3">Não é possível arquivar uma vaga sem um motivo de inativação preenchido!</div>';
            break;      
    }  
}

// =========================================================================
// 2. MONTAGEM DAS LINHAS DA TABELA (HTML Premium e Totalmente Corrigido)
// =========================================================================
    $resultados = '';

    foreach ((isset($vagas) && is_array($vagas) ? $vagas : []) as $vaga) {
        // BADGES DE STATUS: Trocamos o bloco de cor sólida por uma borda fina e texto colorido.
        // "badge-pill" deixa as pontas arredondadas. "bg-white" mantém o fundo limpo.
        if ($vaga->ativo == true || $vaga->ativo == 1) {
            $status = '<span class="badge badge-pill text-success bg-white border border-success px-2.5 py-1" style="font-weight: 600; font-size: 0.8rem;">Ativo</span>';
        } else {
            $status = '<span class="badge badge-pill text-danger bg-white border border-danger px-2.5 py-1" style="font-weight: 600; font-size: 0.8rem;">Inativo</span>';
        }

        // Condicional para vagas arquivadas que você implementou
        if(isset($vaga->arquivada_inativadas) && ($vaga->arquivada_inativadas == 'true' || $vaga->arquivada_inativadas == true)){
            $status = '<span class="badge badge-pill text-secondary bg-white border border-secondary px-2.5 py-1" style="font-weight: 600; font-size: 0.8rem;">Arquivada</span>';
        }

        // Formatação de data padrão
        $dataFormatada = (!empty($vaga->data_criacao) && $vaga->data_criacao !== '[null]') ? date('d/m/Y H:i', strtotime($vaga->data_criacao)) : 'Sem data';

        // CONSTRUÇÃO DA LINHA (<tr>): Concatenação de string do PHP corrigida com o ponto (.) correto no final
        $resultados .= '<tr>
                            <td class="text-muted small align-middle pl-3">#'.$vaga->id.'</td>
                            
                            <td class="font-weight-bold text-dark align-middle" style="font-size: 0.95rem;">'.$vaga->titulo.'</td>
                            
                            <td class="align-middle">
                                <div class="custom-text-truncate text-secondary" title="'.htmlspecialchars($vaga->descricao).'">
                                    '.$vaga->descricao.'
                                </div>
                            </td>
                            
                            <td class="align-middle">'.$status.'</td>
                            
                            <td class="text-muted small align-middle">'.$dataFormatada.'</td>
                            
                            <td class="align-middle">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 6px;">
                                    <a href="editar.php?id='.$vaga->id.'" class="btn btn-sm btn-outline-primary border-0 btn-action-clean py-1 px-2">Editar</a>
                                    <a href="inativar.php?id='.$vaga->id.'" class="btn btn-sm btn-outline-warning border-0 btn-action-clean py-1 px-2 text-warning">Inativar</a>
                                    <a href="arquivar.php?id='.$vaga->id.'" class="btn btn-sm btn-outline-danger border-0 btn-action-clean py-1 px-2">Arquivar</a>
                                </div>
                            </td>
                        </tr>';
    }

    // Validação caso a tabela venha sem registros do PostgreSQL
    $resultados = strlen($resultados) ? $resultados : '<tr><td colspan="6" class="text-center text-muted py-5">Nenhuma vaga cadastrada no momento.</td></tr>';
?>

<style>
    /* Força o display flex funcionar perfeitamente no Bootstrap 4 */
    .d-flex { display: flex !important; }

    /* Transição suave de cor nos botões de ação e fundo cinza sutil ao passar o mouse */
    .btn-action-clean { font-weight: 600; font-size: 0.85rem; border-radius: 4px; transition: all 0.2s ease-in-out; }
    .btn-action-clean:hover { background-color: #f1f3f5 !important; text-decoration: none; }
    
    /* Envelopamento da tabela em formato de Card moderno (Bordas arredondadas e sombra suave) */
    .table-container-card { background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.01), 0 1px 3px rgba(0,0,0,0.02); border: 1px solid #e9ecef; overflow: hidden; }
    
    /* Garante que o texto da descrição mude para "..." de forma limpa sem esticar a tabela para os lados */
    .custom-text-truncate { max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 0.9rem; }
    
    /* Ajustes das células e cabeçalho da tabela */
    .table td { border-top: 1px solid #f8f9fa !important; }
    .table thead th { background-color: #f8f9fa; border-bottom: 2px solid #e9ecef !important; color: #6c757d; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 700; }
</style>

<main>  
    <?=$mensagem?>
          
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h2 class="h4 font-weight-bold text-dark mb-1">Painel Administrativo</h2>
            <p class="text-muted small mb-0">Gerencie e publique novas oportunidades do sistema</p>
        </div>
        <a href="cadastrar.php" class="btn btn-primary px-3 font-weight-bold shadow-sm" style="font-size: 0.9rem; border-radius: 6px; padding: 8px 16px;">
            + Criar Nova Vaga
        </a>
    </div>

    <section class="my-3 bg-white p-3 rounded border shadow-sm" style="border-color: #e9ecef !important; border-radius: 8px !important;">
      <form method="get">
        <div class="form-row align-items-center">
          <div class="col-md-9">
            <input type="text" name="busca" class="form-control text-secondary" style="font-size: 0.9rem; border-radius: 6px; height: 40px;" placeholder="Buscar vaga por título do cargo..." value="<?=$_GET['busca'] ?? ''?>">
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-dark btn-block font-weight-bold" style="font-size: 0.9rem; border-radius: 6px; height: 40px;">Filtrar Vagas</button>
          </div>
        </div>
      </form>
    </section>

        <section class="mt-4 mb-5 table-container-card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col" width="70" class="pl-3">ID</th>
                            <th scope="col" width="220">Título do Cargo</th>
                            <th scope="col">Descrição das Atividades</th>
                            <th scope="col" width="110">Status</th>
                            <th scope="col" width="150">Data de Criação</th>
                            <th scope="col" width="240" class="text-center">Ações</th>
                        </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>
        </div>
    </section>

</main>