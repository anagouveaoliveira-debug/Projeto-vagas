<?php 


require __DIR__ . '/vendor/autoload.php';

// Inicializa a sessão para conseguir transferir dados entre as páginas PHP
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('TITLE', 'Cadastrar Vaga');


use \App\Entity\Vaga;

// Instancia uma vaga limpa para o formulário inicial não dar erro de variável
$obVaga = new Vaga;

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
if($_POST['ativo'] === 'false' && !isset($_POST['motivo_inativacao'])){

 // Guarda o que o usuário já digitou em um rascunho na sessão
        $_SESSION['vaga_rascunho'] = [
            'titulo'    => $_POST['titulo'],
            'descricao' => $_POST['descricao'],
            'ativo'     => $_POST['ativo']
        ];
        
        // Redireciona imediatamente para a tela focada em pedir o motivo
        header('location: cadastrar-motivo.php');
        exit;
    }

// FLUXO NORMAL: Se for Ativo (ou se o motivo já veio preenchido da segunda tela)
    $obVaga->titulo            = $_POST['titulo'];
    $obVaga->descricao         = $_POST['descricao'];
    $obVaga->ativo             = $_POST['ativo'];
    $obVaga->motivo_inativacao = $_POST['motivo_inativacao'] ?? null;

    $obVaga->cadastrar();

    // Limpa o rascunho da sessão após salvar com sucesso
    unset($_SESSION['vaga_rascunho']);

    header('location: index.php?status=success');
    exit;
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario.php';
include __DIR__ . '/includes/footer.php';