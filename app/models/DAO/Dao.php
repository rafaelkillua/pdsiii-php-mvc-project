<?php
abstract class Dao {
  
  protected $pdo;
  
  public function __construct() {
    require_once PATH_APP."/config/banco.php";
    
    $this->pdo = $conexaoBanco;
  }
  
  public abstract function inserir($obj);
  public abstract function atualizar($obj);
  public abstract function excluir($id);
  public abstract function buscar($id);
  public abstract function buscarTodos();
}
