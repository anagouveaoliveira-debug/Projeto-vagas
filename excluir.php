<?php 

require __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Excluir Vaga');

use \App\Entity\Vaga;

// VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

// CONSULTA A VAGA
$obVaga = Vaga::getVaga($_GET['id']);

// VALIDAÇÃO DA VAGA
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

// VALIDAÇÃO DO POST (Só entra aqui quando você clica no botão vermelho "Excluir")
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Chama o método para deletar do banco
    $obVaga->excluir();
    
    // 2. Agora sim, redireciona após excluir com sucesso
    header('location: index.php?status=success');
    exit;
}

// Se NÃO for POST (ou seja, quando você acabou de entrar na página), 
// ele ignora o IF acima e carrega a tela de confirmação abaixo:
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/confirmar-exclusao.php';
include __DIR__ . '/includes/footer.php';