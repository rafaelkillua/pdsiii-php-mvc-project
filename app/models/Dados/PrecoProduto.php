<?php

class PrecoProduto {
  
  private $id;
  private $produto; // Objeto
  private $precoCompra;
  private $precoVenda;
  private $quantidade;
  private $status;
  
  public function __construct($id, $produto, $precoCompra, $precoVenda, $quantidade, $status=1) {
    $this->id = $id;
    $this->produto = $produto;
    $this->precoCompra = $precoCompra;
    $this->precoVenda = $precoVenda;
    $this->quantidade = $quantidade;
    $this->status = $status;
  }

  public function getId() {
    return $this->id;
  }

  public function getProduto() {
    return $this->produto;
  }

  public function getPrecoCompra() {
    return $this->precoCompra;
  }

  public function getPrecoVenda() {
    return $this->precoVenda;
  }

  public function getQuantidade() {
    return $this->quantidade;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setProduto($produto) {
    $this->produto = $produto;
  }

  public function setPrecoCompra($precoCompra) {
    $this->precoCompra = $precoCompra;
  }

  public function setPrecoVenda($precoVenda) {
    $this->precoVenda = $precoVenda;
  }

  public function setQuantidade($quantidade) {
    $this->quantidade = $quantidade;
  }

  public function setStatus($status) {
    $this->status = $status;
  }
}
