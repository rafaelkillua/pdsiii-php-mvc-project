<?php
require_once PATH_APP."/controllers/ControladorCore.php";

class AcoesProduto extends ControladorCore {
  
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
          echo (new PrecoProdutoDao())->inserir($precoProduto);
          
          header("Location:".BASE_URL."/painel");
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

  public function editarProduto() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      var_dump($_POST);
      if (!empty($_POST['id']) && 
      !empty($_POST['precoCompra']) && 
      !empty($_POST['precoVenda']) && 
      !empty($_POST['quantidade'])) {
        require_once PATH_APP."/models/Dados/Produto.php";
        require_once PATH_APP."/models/DAO/ProdutoDao.php";
        require_once PATH_APP."/models/Dados/PrecoProduto.php";
        require_once PATH_APP."/models/DAO/PrecoProdutoDao.php";

        try {
          $precoProdutoDao = new PrecoProdutoDao();
          $precoProduto = $precoProdutoDao->buscar($_POST["id"]);
          
          $precoProduto->setPrecoCompra($_POST["precoCompra"]);
          $precoProduto->setPrecoVenda($_POST["precoVenda"]);
          $precoProduto->setQuantidade($_POST["quantidade"]);
          
          $precoProduto = $precoProdutoDao->atualizar($precoProduto);
          var_dump($precoProduto);
          // header("Location:".BASE_URL."/painel");
          return;
        } catch (Exception $ex) {
          $_SESSION['erro'] = $ex->getMessage();
        }
      } else {
        $_SESSION['erro'] = "Informe todos os campos obrigatórios";
      }
      // header("Location:".BASE_URL."/produto/editar?id=".$_POST["id_produto"]);
    }
  }
}