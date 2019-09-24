<?php

class PrecoProduto {
  
  private $id;
  private $produto; // Objeto
  private $precoCompra;
  private $precovenda;
  private $quantidade;
  private $status;
  
  public function __construct($id, $produto, $precoCompra, $precovenda, $quantidade, $status=1) {
    $this->id = $id;
    $this->produto = $produto;
    $this->precoCompra = $precoCompra;
    $this->precovenda = $precovenda;
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

  public function getPrecovenda() {
    return $this->precovenda;
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

  public function setPrecovenda($precovenda) {
    $this->precovenda = $precovenda;
  }

  public function setQuantidade($quantidade) {
    $this->quantidade = $quantidade;
  }

  public function setStatus($status) {
    $this->status = $status;
  }
}
