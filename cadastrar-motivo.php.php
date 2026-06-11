<?php
require __DIR__.'/vendor/autoload.php';

// Inicializa a sessão para ler o rascunho guardado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use \App\Entity\Vaga;

// Proteção: Se tentarem entrar direto nessa URL sem dados na sessão, volta pro cadastro
if(!isset($_SESSION['vaga_rascunho'])){
    header('location: cadastrar.php');
    exit;
}

// Verifica se o formulário exclusivo de motivo foi enviado
if(isset($_POST['motivo_inativacao'])){
    
    // Cria o objeto Vaga juntando o Rascunho da Sessão + o Motivo do POST
    $obVaga = new Vaga;
    $obVaga->titulo            = $_SESSION['vaga_rascunho']['titulo'];
    $obVaga->descricao         = $_SESSION['vaga_rascunho']['descricao'];
    $obVaga->ativo             = $_SESSION['vaga_rascunho']['ativo']; // 'false'
    $obVaga->motivo_inativacao = $_POST['motivo_inativacao'];
    
    // Salva no banco de dados PostgreSQL usando o método que já corrigimos
    $obVaga->cadastrar();
    
    // Limpa a sessão para não acumular l   ixo
    unset($_SESSION['vaga_rascunho']);

    // Redireciona para o painel principal com sucesso
    header('location: index.php?status=success');
    exit;
}

// Inclui a estrutura visual padrão do seu curso
include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-motivo-cadastro.php'; 
include __DIR__.'/includes/footer.php';