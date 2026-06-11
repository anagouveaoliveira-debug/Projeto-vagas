 <?php 

require __DIR__ .  '/vendor/autoload.php';

use \App\Entity\Vaga;

// 1. Captura a busca se ela existir na URL (?busca=...)
$busca = filter_input(INPUT_GET, 'busca', FILTER_UNSAFE_RAW);

// 2. Cria as condições de filtro (começa vazia)
$where = "arquivada_inativadas = false OR arquivada_inativadas IS NULL";

if(isset($_GET['busca']) && $_GET['busca'] != ''){
    $where .= " AND titulo ILIKE '%".$_GET['busca']."%'";
}

// 3. Passa a condição para o método que busca no banco


$vagas = Vaga::getVagas($where);


include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/listagem.php';
include __DIR__ . '/includes/footer.php';