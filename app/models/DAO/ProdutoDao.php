<?php
require_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/Produto.php";

class ProdutoDao extends Dao {
  
  public function atualizar($obj) {
    
  }

  public function buscar($id) {
    try {
      $sql = "SELECT * FROM tb_produto WHERE id = :identificador";
      $requisicao = $this->pdo->prepare($sql);
      $requisicao->bindValue(":identificador", $id);
      $requisicao->execute();
      
      $resultado = $requisicao->fetch();
      
      
      
    } catch (Exception $ex) {

    }
    return $resultado;
  }

  public function buscarTodos() {
    $produtos = array();
    try {
      $sql = "SELECT * FROM tb_produto";
      $requisicao = $this->pdo->prepare($sql);
      $requisicao->execute();
      
      $resultado = $requisicao->fetchAll();
      
      foreach ($resultado as $r) {
        array_push($produtos, 
            new Produto($r['id'], $r['nome']));
      }
      
    } catch (Exception $ex) {}
    
    return $produtos;
  }

  public function excluir($id) {
    
  }

  public function inserir($obj) {
    
  }

}
