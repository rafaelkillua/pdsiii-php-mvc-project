<?php

class Venda {
  
  private $id;
  private $statusVenda;
  private $cliente;
  private $data;
  
  public function __construct($id, $statusVenda=null, $cliente, $data) {
    $this->id = $id;
    $this->statusVenda = $statusVenda;
    $this->cliente = $cliente;
    $this->data = $data;
  }

  public function getId() {
    return $this->id;
  }

  public function getStatusVenda() {
    return $this->statusVenda;
  }

  public function getData() {
    return $this->data;
  }

  public function getCliente() {
    return $this->cliente;
  }

  public function setId($id) {
    $this->id = $id;
  }
  
  public function setStatusVenda($statusVenda) {
    $this->statusVenda = $statusVenda;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function setCliente($cliente) {
    $this->cliente = $cliente;
  }
}
