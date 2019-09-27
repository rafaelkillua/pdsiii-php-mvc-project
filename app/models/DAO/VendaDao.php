<?php
include_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/Venda.php";
require_once PATH_APP."/models/Dados/StatusVenda.php";
require_once PATH_APP."/models/Dados/ItemVenda.php";
class VendaDao extends Dao {
  
  public function atualizar($obj) {
  }

  public function buscar($id) {
  }

  public function buscarTodos() {
  }

  public function excluir($id) {
  }

  public function inserir($itemVenda) {
    if (!$itemVenda || empty($itemVenda)){
      throw new Exception("Alguma coisa deu errado");
      return;
    }
    $this->pdo->beginTransaction();

    // STATUS VENDA
    $statusVenda = $itemVenda->getVenda()->getStatusVenda();
    $sql1 = "INSERT INTO tb_status_venda (nome) VALUES (:nome)";
    $req1 = $this->pdo->prepare($sql1);
    $req1->bindValue(":nome", $statusVenda->getNome());
    $req1->execute();
    if ($req1->rowCount() == 0) {
      $this->pdo->rollBack();
      throw new Exception("Houve algum erro ao adicionar StatusVenda.");
    }
    $statusVenda->setId($this->pdo->lastInsertId());
    
    // VENDA
    $venda = $itemVenda->getVenda();
    $sql2 = "INSERT INTO tb_venda (tb_status_venda_id, usuario_cliente, data) VALUES (:status_venda, :cliente, :data)";
    $req2 = $this->pdo->prepare($sql2);
    $req2->bindValue(":status_venda", $statusVenda->getId());
    $req2->bindValue(":cliente", $venda->getCliente()->getId());
    $req2->bindValue(":data", $venda->getData());
    $req2->execute();
    if ($req2->rowCount() == 0) {
      $this->pdo->rollBack();
      throw new Exception("Houve algum erro ao adicionar Venda.");
    }
    $venda->setId($this->pdo->lastInsertId());

    // ITEM VENDA
    $sql3 = "INSERT INTO tb_item_venda (tb_venda_id, tb_preco_produto_id, quantidade) VALUES (:venda, :preco_produto, :quantidade)";
    $req3 = $this->pdo->prepare($sql3);
    $req3->bindValue(":venda", $venda->getId());
    echo "<pre>".print_r($itemVenda, true)."</pre>";
    $req3->bindValue(":preco_produto", $itemVenda->getPrecoProduto()->getId());
    $req3->bindValue(":quantidade", $itemVenda->getQuantidade());
    $req3->execute();
    if ($req3->rowCount() == 0) {
      $this->pdo->rollBack();
      throw new Exception("Houve algum erro ao adicionar ItemVenda.");
    }

    $this->pdo->commit();
    return $this->pdo->lastInsertId();
  }
}
