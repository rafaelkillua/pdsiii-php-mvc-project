<?php
include_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/PrecoProduto.php";
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

  public function inserir($precoProduto) {
    if (!$precoProduto || empty($precoProduto)){
      throw new Exception("Alguma coisa deu errado");
      return;
    }

    $sql = "INSERT INTO tb_preco_produto (tb_produto_id, preco_compra, preco_venda, quantidade, status) VALUES (:produto_id, :preco_compra, :preco_venda, :quantidade, :status)";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(":produto_id", $precoProduto->getProduto()->getId());
    $req->bindValue(":preco_compra", $precoProduto->getPrecoCompra());
    $req->bindValue(":preco_venda", $precoProduto->getPrecoVenda());
    $req->bindValue(":quantidade", $precoProduto->getQuantidade());
    $req->bindValue(":status", $precoProduto->getStatus());
    $req->execute();
    if ($req->rowCount() == 0) {
      throw new Exception("Houve algum erro.");
    }
    return $this->pdo->lastInsertId();
  }
}
