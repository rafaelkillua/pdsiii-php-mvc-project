<?php

class ItemVenda {
  
  private $id;
  private $venda;
  private $precoProduto;
  private $quantidade;
  
  public function __construct($id, $venda, $precoProduto, $quantidade) {
    $this->id = $id;
    $this->venda = $venda;
    $this->precoProduto = $precoProduto;
    $this->quantidade = $quantidade;
  }

  public function getId() {
    return $this->id;
  }

  public function getVenda() {
    return $this->venda;
  }

  public function getPrecoProduto() {
    return $this->precoProduto;
  }

  public function getQuantidade() {
    return $this->quantidade;
  }

  public function setId($id) {
    $this->id = $id;
  }
  
  public function setVenda($venda) {
    $this->venda = $venda;
  }

  public function setPrecoProduto($precoProduto) {
    $this->precoProduto = $precoProduto;
  }
  
  public function setQuantidade($quantidade) {
    $this->quantidade = $quantidade;
  }
}
