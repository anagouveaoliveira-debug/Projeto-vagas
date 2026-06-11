<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{

/**Host de conexão com o banco de dados
 * @var string
 */
const HOST = 'localhost';

/**Nome do banco de dados
 * @var string
 */
const NAME = 'Atividades';
    
/**Usuario do banco de dados
 * @var string
 */    
const USER = 'postgres';


/**Senha do banco de dados
 * @var string
 */    
const PASS = 'postgres';

// No seu método setConnection, adicione a porta à string de conexão:
 const PORT = '5432';


/**Nome da tabela a ser manipulada
 * @var string
 */    
private $table;         

/**Instancia de conexão com o banco de dados
 * @var \PDO
 */
private $connection;

/**Define a tabela e instancia a conexão
 * @param string $table
 */
public function __construct($table = null){
    $this->table = $table;
    $this->setConnection();
}

/**Metodo responsavel por criar uma conexão com o banco de dados
 * @return void
 */
private function setConnection(){
    try {
        // AQUI: Verifique se usou 'pgsql' e se incluiu a 'port'
        $this->connection = new PDO('pgsql:host='.self::HOST.';port='.self::PORT.';dbname='.self::NAME, self::USER, self::PASS);
        
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } catch(\PDOException $e){ // AQUI: Precisa ter a barra \ antes de PDOException
        die('ERROR: '.$e->getMessage());
    }
}

/**Metodo responsável por executar queries no banco de dados
 * @param string $query
 * @param array $params
 * @return \PDOStatement
 */
public function execute($query, $params = []){
    try {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
     } catch(\PDOException $e){ // AQUI: Precisa ter a barra \ antes de PDOException
        die('ERROR: '.$e->getMessage());
    }
}


/**
 * ESSA É A PARTE QUE FALTAVA:
 * Método responsável por inserir dados no banco (Versão PostgreSQL)
 * @param array $values [ field => value ]
* @return integer ID do registro inserido
 */
public function insert($values){
// Dados da query
    $fields = array_keys($values); 
    $binds = array_pad([], count($fields), '?');


//MONTAR A QUERY 
    $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';
    
//EXECUTA O INSERT
    $this->execute($query, array_values($values));    

//RETORNA O ID DA INSERÇÃO
return $this->connection->lastInsertId();

}
/**Metodo responsável por executar uma consulta no Banco
 * @param string $where 
 * @param string $order 
 *  @param string $limit
 * @return \PDOStatement
 */
public function select($where = null, $order = null, $limit = null, $fields = '*'){
    //Dados da query
    $where = strlen($where) ? 'WHERE '.$where : '';
    $order = strlen($order) ? 'ORDER BY '.$order : '';
    $limit = strlen($limit) ? 'LIMIT '.$limit : '';
//MONTAR A QUERY
    $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
 
     
//Executar a query    
    return $this->execute($query);

}

/**Metodo responsável por atualizar os dados no banco
 * @param string $where
 * @param array $values [ field => value ]
 * @return boolean
 */
public function update($where, $values){
    // Captura apenas os nomes das colunas (Ex: titulo, ativo, motivo_inativacao)
    $fields = array_keys($values);
      
    //  CORREÇÃO DE SINTAXE PARA O POSTGRES: 
    // Monta a estrutura correta: coluna1 = ?, coluna2 = ?, coluna3 = ?
    $query = 'UPDATE '.$this->table.' SET '.implode(' = ?, ', $fields).' = ? WHERE '.$where;

    // CÓDIGO DE RASTREAMENTO (DEBUG):
    // Descomente as 3 linhas abaixo caso queira ver a query exata na tela branca se der erro
    // echo "Query gerada: " . $query . "<br>";
    // echo "<pre>Valores enviados: "; print_r(array_values($values)); echo "</pre>"; exit;

    // Executar a query passando os valores que vão substituir os '?'
    $this->execute($query, array_values($values));
     
    /**Retornar sucesso*/
    return true;
}


/**
 * Método responsável por excluir dados do banco
 * @param string $where
 * @return boolean
 */
public function delete($where){
    // MONTAR A QUERY
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

    // Executar a query
    $this->execute($query); 
   
    // RETORNAR SUCESSO (Faltava essa linha!)
    return true;
}

}
