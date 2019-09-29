<?php
include_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/Venda.php";
require_once PATH_APP."/models/Dados/StatusVenda.php";
require_once PATH_APP."/models/Dados/ItemVenda.php";
class VendaDao extends Dao {
  
  public function atualizar($obj) {
  }

  public function buscarPorUsuario($usuario) {
    require_once PATH_APP."/models/Dados/Produto.php";
    require_once PATH_APP."/models/Dados/PrecoProduto.php";
    
    $sql = "SELECT 
            sv.id as status_venda_id, sv.nome as status_venda_nome,
            v.id as venda_id, v.data as venda_data,
            iv.id as item_venda_id, iv.quantidade as item_venda_quantidade,
            pp.id as preco_produto_id, pp.preco_compra, pp.preco_venda, pp.quantidade as preco_produto_quantidade, pp.status,
            p.id as produto_id, p.nome as produto_nome 
            FROM tb_venda v 
            JOIN tb_status_venda sv ON sv.id = v.tb_status_venda_id 
            JOIN tb_item_venda iv ON iv.tb_venda_id = v.id
            JOIN tb_preco_produto pp ON pp.id = iv.tb_preco_produto_id
            JOIN tb_produto p ON pp.tb_produto_id = p.id
            WHERE v.usuario_cliente = :usuario_id 
            AND pp.status = 1";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(":usuario_id", $usuario->getId());
    $req->execute();
    if ($req->rowCount() == 0) {
      throw new Exception("Houve algum erro ao pesquisar as vendas do usuário.");
    }
    
    $vendas = array();
    $result = $req->fetchAll();
    foreach ($result as $key => $value) {
      $statusVenda = new StatusVenda($value["status_venda_id"], $value["status_venda_nome"]);
      $data = (new DateTime($value["venda_data"]))->setTimezone(new DateTimeZone('America/Sao_Paulo'));
      $venda = new Venda($value["venda_id"], $statusVenda, $usuario, $data->format("Y-m-d H:i:s"));
      $produto = new Produto($value["produto_id"], $value["produto_nome"]);
      $precoProduto = new PrecoProduto($value["preco_produto_id"], $produto, $value["preco_compra"], $value["preco_venda"], $value["preco_produto_quantidade"], $value["status"]);
      $itemVenda = new ItemVenda($value["item_venda_id"], $venda, $precoProduto, $value["preco_produto_quantidade"]);
      array_push($vendas, $itemVenda);
    }
    return $vendas;
  }

  public function buscarTodos() {
  }

  public function buscar($id) {
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
