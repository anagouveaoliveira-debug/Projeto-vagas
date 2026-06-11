<?php
require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

// Validação do ID
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

// Busca a vaga no banco
$obVaga = Vaga::getVaga($_GET['id']);

// Valida se a vaga existe
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

// 🛑 TRAVA 1: Não deixa arquivar se a vaga estiver ATIVA
if($obVaga->ativo == true || $obVaga->ativo === 'true' || $obVaga->ativo == 1 || $obVaga->ativo === 't'){
    header('location: index.php?status=vaga_ativa');
    exit;
}

// 🛑 TRAVA 2: Não deixa arquivar se NÃO tiver motivo de inativação
if(empty($obVaga->motivo_inativacao) || $obVaga->motivo_inativacao === '[null]' || trim($obVaga->motivo_inativacao) === ''){
    header('location: index.php?status=sem_motivo');
    exit;
}

// Executa o método atualizar que você acabou de ajustar!
$obVaga->arquivada_inativadas = 'true';
$obVaga->atualizar();

// Redireciona de volta para a index com sucesso
header('location: index.php?status=success');
exit;