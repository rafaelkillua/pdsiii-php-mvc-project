<?php
require_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/DAO/ProdutoDao.php";
require_once PATH_APP."/models/dados/PrecoProduto.php";
require_once PATH_APP."/models/dados/Produto.php";


class PrecoProdutoDao extends Dao {
  
  public function atualizar($obj) {
    
  }

  public function buscar($id) {
    try {
      $sql = "SELECT * FROM tb_preco_produto WHERE id = :id";
      $requisicao = $this->pdo->prepare($sql);
      $requisicao->bindValue(":id", $id);
      $requisicao->execute();
      
      $resultado = $requisicao->fetch();
      
      if (!empty($resultado)) {
        $pDAO = new ProdutoDao();
        $produto = $pDAO->buscar($resultado['tb_produto_id']);
        
        return new PrecoProduto($resultado['id'], 
            $produto, $resultado['preco_compra'], 
            $resultado['preco_venda'], $resultado['quantidade'], 
            $resultado['status']);
      }
      
    } catch (Exception $ex) {
      echo "DEU ERRO".$ex->getMessage();
    }
  }

  public function buscarTodos() {
    
  }

  public function excluir($id) {}

  public function inserir($obj) {
    
  }

}
