<?php

//class referente ao produto
class Produto {
    public $id;
    public $nome_produto;
    public $preco_da_caixa;
    public $meta_por_caixa;
    public $meta_por_unidade;
    public $total_meta;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }
}    
class Conexao {
    private $host = 'localhost';
    private $dbname = 'meta';
    private $user = 'root';
    private $pass = '';

    public function conectar() {
        try{
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );
            $conexao->exec('set charset utf8');
            return $conexao;

        } catch (PDOException $e){
            echo '<p>'. $e->getMessage().'</p>';
        }
    }
}
//classe (model para o banco)
class Bd{
    private $conexao;
    private $produto;

    public function __construct(Conexao $conexao,Produto $produto){
        $this->conexao = $conexao->conectar();
        $this->produto = $produto;
    }  
    public function getConsultarNome() {
        $query = '
            select
              *
            from
                tb_produtos
            ';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   
    
}
$produto = new Produto();
$conexao = new Conexao();
$bd = new Bd($conexao, $produto);

$lista = $bd->getConsultarNome();

     foreach($lista as $key => $value){
         $produto->__set('nome_produto', $value['nome_produto']);
         $produto->__set('id', $value['id']);
         $produto->__set('preco_da_caixa', $value['preco_da_caixa']);
    }
?>