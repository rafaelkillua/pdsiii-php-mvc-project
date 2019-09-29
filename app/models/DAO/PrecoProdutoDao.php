<?php
include_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/PrecoProduto.php";
require_once PATH_APP."/models/Dados/Produto.php";
class PrecoProdutoDao extends Dao {
  
  public function atualizar($precoProduto) {
    if (!$precoProduto || empty($precoProduto)){
      throw new Exception("Alguma coisa deu errado");
      return;
    }

    $sql = "UPDATE tb_preco_produto
            SET status = 0
            WHERE id = :id AND status = 1";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(":id", $precoProduto->getId());
    $req->execute();
    if ($req->rowCount() == 0) {
      throw new Exception("Houve algum erro.");
    }
    
    $novoPrecoProduto = new PrecoProduto(null, $precoProduto->getProduto(), $precoProduto->getPrecoCompra(), $precoProduto->getPrecoVenda(), $precoProduto->getQuantidade());
    $novoId = $this->inserir($novoPrecoProduto);
    $novoPrecoProduto->setId($novoId);

    return $novoPrecoProduto;
  }

  public function buscar($id) {
    $sql = "SELECT pp.id, p.id as produto_id, p.nome, pp.preco_compra, pp.preco_venda, pp.quantidade, pp.status
            FROM tb_preco_produto pp
            JOIN tb_produto p ON pp.tb_produto_id = p.id
            WHERE pp.id = :id AND status = 1";
    $requisicao = $this->pdo->prepare($sql);
    $requisicao->bindValue(":id", $id);
    $requisicao->execute();
    
    $resultado = $requisicao->fetch();
    
    if (!empty($resultado)) {
      $produto = new Produto($resultado['produto_id'], $resultado['nome']);

      return new PrecoProduto($resultado['id'], 
          $produto, $resultado['preco_compra'], 
          $resultado['preco_venda'], $resultado['quantidade'], 
          $resultado['status']);
    } else {
      return null;
    }
  }

  public function buscarPorProduto($id_produto) {
    $sql = "SELECT pp.id, p.id as produto_id, p.nome, pp.preco_compra, pp.preco_venda, pp.quantidade, pp.status
            FROM tb_preco_produto pp
            JOIN tb_produto p ON pp.tb_produto_id = p.id
            WHERE p.id = :id AND status = 1";
    $requisicao = $this->pdo->prepare($sql);
    $requisicao->bindValue(":id", $id_produto);
    $requisicao->execute();
    
    $resultado = $requisicao->fetch();
    
    if (!empty($resultado)) {
      $produto = new Produto($resultado['produto_id'], $resultado['nome']);

      return new PrecoProduto($resultado['id'], 
          $produto, $resultado['preco_compra'], 
          $resultado['preco_venda'], $resultado['quantidade'], 
          $resultado['status']);
    } else {
      return null;
    }
  }

  public function buscarTodos() {
    
  }

  public function excluir($id) {
    
  }

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
