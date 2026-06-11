<?php   

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{

    /**
     * Identificador único da vaga 
     * @var integer
     */
    public $id;     

    /**
     * Título da vaga
     * @var string
     */       
    public $titulo;

    /**
     * Descrição da vaga (pode conter HTML)
     * @var string
     */
    public $descricao;

    /**
     * Define se a vaga está ativa ou não
     * @var string
     */ 
    public $ativo;

    /**
     * Data de publicação da vaga (Mapeado com o Postgres)
     * @var string
     */
    public $data_criacao;

    /**
     * Motivo de a vaga ter sido inativada
     * @var string
     */
    public $motivo_inativacao;

    // No topo da classe, mantenha ou adicione a propriedade:
    public $arquivada_inativadas;

   /**
     * Método responsável por cadastrar a nova vaga no Banco 
     * @return boolean
     */
    public function cadastrar(){
        // Garante a definição da data caso venha vazia
        if(empty($this->data_criacao) || $this->data_criacao === '[null]'){
            $this->data_criacao = date('Y-m-d H:i:s');
        }
       
        // Define o status ativo/inativo tratando a string do formulário
        if ($this->ativo === 'false' || $this->ativo === false || $this->ativo == 0) {
            $statusAtivo = 'false';
        } else {
            $statusAtivo = 'true';
        }
        
        // Define na propriedade do objeto que a vaga nasce NÃO arquivada
        $this->arquivada_inativadas = 'false';

        // Inserir a vaga no banco PostgreSQL
        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
            'titulo'               => $this->titulo,
            'descricao'            => $this->descricao, // Ajustado para o nome exato do seu banco
            'ativo'                => $statusAtivo, 
            'data_criacao'         => $this->data_criacao,
            'motivo_inativacao'    => (!empty($this->motivo_inativacao) && $this->motivo_inativacao !== '[null]') ? $this->motivo_inativacao : null,
            'arquivada_inativadas' => 'false'
        ]);
         
        return true;       
    }

    /**
     * Método responsável por atualizar a vaga no Banco
     * @return boolean
     */
    public function atualizar(){
        // Garante a data para não quebrar registros antigos
        if(empty($this->data_criacao) || $this->data_criacao === '[null]'){
            $this->data_criacao = date('Y-m-d H:i:s');
        }

        // Validação rigorosa de texto para o campo 'ativo' no Postgres
        if ($this->ativo === 'false' || $this->ativo === false || $this->ativo == 0 || $this->ativo === 'f') {
            $statusAtivo = 'false';
        } else {
            $statusAtivo = 'true';
        }

        // Validação rigorosa de texto para o campo 'arquivada_inativadas' no Postgres
        if ($this->arquivada_inativadas === 'true' || $this->arquivada_inativadas === true || $this->arquivada_inativadas == 1 || $this->arquivada_inativadas === 't') {
            $statusArquivado = 'true';
        } else {
            $statusArquivado = 'false';
        }

        // Executa a query mandando estritamente as strings 'true' ou 'false'
        return (new Database('vagas'))->update('id = '.$this->id, [
            'titulo'               => $this->titulo,      
            'descricao'            => $this->descricao, // Ajustado para o nome exato do seu banco
            'ativo'                => $statusAtivo,          
            'data_criacao'         => $this->data_criacao,
            'motivo_inativacao'    => (!empty($this->motivo_inativacao) && $this->motivo_inativacao !== '[null]') ? $this->motivo_inativacao : null,
            'arquivada_inativadas' => $statusArquivado
        ]);   
    }
    
    /**
     * Método responsável por excluir a vaga do Banco de dados
     * @return boolean
     */   
    public function excluir(){
        return (new Database('vagas'))->delete('id = '.$this->id);
    }

    /**
     * Método responsável por obter as vagas cadastradas no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */     
    public static function getVagas($where = null, $order = null, $limit = null){
        return (new Database('vagas'))->select($where, $order, $limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por obter uma vaga com base no seu ID
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id){
        return (new Database('vagas'))->select('id = '.$id)
                                      ->fetchObject(self::class);       
    }
}