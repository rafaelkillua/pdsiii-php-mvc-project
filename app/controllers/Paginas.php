<?php
require_once PATH_APP."/controllers/ControladorCore.php";

class Paginas extends ControladorCore {
  
  public function index() {
    if ($this->estaLogado()) {
      header("Location:".BASE_URL."/painel");
      return;
    }
    $this->addTituloPagina("Home");
    $this->carregarView("v_home");
  }

  public function cadastro() {
    if ($this->estaLogado()) {
      header("Location:".BASE_URL."/painel");
      return;
    }
    $this->addTituloPagina("Cadastro");
    $this->carregarView("v_cadastro");
  }

  public function painel() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      $this->carregarDAO("ProdutoDao");
      $this->carregarDAO("VendaDao");

      $produtos = (new ProdutoDao())->buscarTodos();
      $vendas = (new VendaDao())->buscarPorUsuario($this->getUsuarioLogado());

      $this->addDadosPagina("produtos", $produtos);
      $this->addDadosPagina("vendas", $vendas);
      $this->carregarView("v_painel");

      //echo "<pre>".print_r($produtos, true)."</pre>";
    }
  }

  public function detalharProduto() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      $this->carregarDAO("PrecoProdutoDao");
      $id = $_GET['id'];

      $produto = (new PrecoProdutoDao())->buscarPorProduto($id);

      $this->addDadosPagina("produto", $produto);
      $this->carregarView("v_detalhar_produto");

      //echo "<pre>".print_r($produtos, true)."</pre>";
    }
  }

  public function editarProduto() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      $this->carregarDAO("PrecoProdutoDao");
      $id = $_GET['id'];

      $produto = (new PrecoProdutoDao())->buscarPorProduto($id);

      $this->addDadosPagina("produto", $produto);
      $this->carregarView("v_editar_produto");

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
