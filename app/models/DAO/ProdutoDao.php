<?php
include_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/Produto.php";
class ProdutoDao extends Dao {
  
  public function atualizar($obj) {
    
  }

  public function buscar($id) {
    $sql = "SELECT * FROM tb_produto WHERE id = :identificador";
    $requisicao = $this->pdo->prepare($sql);
    $requisicao->bindValue(":identificador", $id);
    $requisicao->execute();
    $resultado = $requisicao->fetch();
    return $resultado;
  }

  public function buscarTodos() {
    $produtos = array();
    $sql = "SELECT * FROM tb_produto";
    $requisicao = $this->pdo->prepare($sql);
    $requisicao->execute();
    $resultado = $requisicao->fetchAll();
    
    foreach ($resultado as $r) {
      array_push($produtos, 
          new Produto($r['id'], $r['nome']));
    }
    return $produtos;
  }

  public function excluir($id) {
    
  }

  public function inserir($produto) {
    if (!$produto || empty($produto)){
      throw new Exception("Alguma coisa deu errado");
      return;
    }

    $sql = "INSERT INTO tb_produto (nome) VALUES (:nome)";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(":nome", $produto->getNome());
    $req->execute();
    if ($req->rowCount() == 0) {
      throw new Exception("Houve algum erro.");
    }
    return $this->pdo->lastInsertId();
  }
}
