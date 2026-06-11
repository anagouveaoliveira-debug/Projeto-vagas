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

// Quando o formulário de inativação for enviado via POST
if(isset($_POST['motivo_inativacao'])){
    
  // Força explicitamente a vaga a se tornar inativa na memória do PHP
    $obVaga->ativo = 'false'; 
    $obVaga->motivo_inativacao = $_POST['motivo_inativacao'];
    
    // Executa o atualizar que agora está preparado no Vaga.php para ler 'false'
    $obVaga->atualizar();

// Redireciona de volta para a index com sucesso
    header('location: index.php?status=success');
    exit;
}

// Caso o seu formulário HTML fique dentro deste próprio arquivo 'inativar.php', 
// o código HTML do input/botão continua aqui embaixo normalmente...
// Renderiza a tela juntando os pedaços estruturados

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-inativar.php'; // Chama o HTML do motivo
include __DIR__.'/includes/footer.php';