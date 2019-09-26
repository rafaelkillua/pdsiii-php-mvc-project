<?php
require_once PATH_APP."/controllers/ControladorCore.php";

class Paginas extends ControladorCore {
  
  public function index() {
    if ($this->estaLogado()) {
      header("Location:".BASE_URL."/produtos");
      return;
    }
    $this->addTituloPagina("Home");
    $this->carregarView("v_home");
  }

  public function cadastro() {
    if ($this->estaLogado()) {
      header("Location:".BASE_URL."/produtos");
      return;
    }
    $this->addTituloPagina("Cadastro");
    $this->carregarView("v_cadastro");
  }

  public function listarProdutos() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      $this->carregarDAO("ProdutoDao");

      $produtos = (new ProdutoDao())->buscarTodos();

      $this->addDadosPagina("produtos", $produtos);
      $this->carregarView("v_produtos");

      //echo "<pre>".print_r($produtos, true)."</pre>";
    }
  }

  public function novoProduto() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL."/");
      return;
    }
    $this->addTituloPagina("Novo Produto");
    $this->carregarView("v_novo_produto");
  }
  
  public function sobre() {
    echo __FUNCTION__;
  }
  
  public function erro404() {
    echo "PAGINA NÃO ENCONTRADA";
  }
}
