<?php
require_once PATH_APP."/controllers/ControladorCore.php";

class AcoesProduto extends ControladorCore {
  
  public function detalharProduto() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      require_once PATH_APP."/models/Dados/Produto.php";
      require_once PATH_APP."/models/DAO/ProdutoDao.php";

      if (isset($_GET["id"])) {
        $produtoBuscado = (new ProdutoDao())->buscar($_GET["id"]);

        $this->addDadosPagina("produto", $produtoBuscado);
        $this->carregarView("v_detalhar_produto");

      } else {
        echo "Informe todos os campos obrigatórios...";
      }
    }
  }

  public function cadastrarProduto() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      if (!empty($_POST['nome']) && 
      !empty($_POST['preco_compra']) && 
      !empty($_POST['preco_venda']) && 
      !empty($_POST['quantidade'])) {
        require_once PATH_APP."/models/Dados/Produto.php";
        require_once PATH_APP."/models/DAO/ProdutoDao.php";
        require_once PATH_APP."/models/Dados/PrecoProduto.php";
        require_once PATH_APP."/models/DAO/PrecoProdutoDao.php";
        
        $produto = new Produto(null, $_POST['nome']);
        try {
          $id = (new ProdutoDao())->inserir($produto);
          $produto->setId(intval($id));
          
          $precoProduto = new PrecoProduto(null, $produto, $_POST['preco_compra'], $_POST['preco_venda'], $_POST['quantidade']);
          (new PrecoProdutoDao())->inserir($precoProduto);
          
          header("Location:".BASE_URL."/produtos");
          return;
        } catch (Exception $ex) {
          $_SESSION['erro'] = $ex->getMessage();
        }
        
      } else {
        $_SESSION['erro'] = "Informe todos os campos obrigatórios";
      }
      header("Location:".BASE_URL."/produto/novo");
    }
  }
}