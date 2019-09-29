<?php
require_once PATH_APP."/controllers/ControladorCore.php";

class AcoesVenda extends ControladorCore {

  public function cadastrarVenda() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      if (!empty($_POST['quantidade']) && 
      !empty($_GET['id'])) {
        require_once PATH_APP."/models/Dados/Venda.php";
        require_once PATH_APP."/models/Dados/StatusVenda.php";
        require_once PATH_APP."/models/Dados/ItemVenda.php";
        require_once PATH_APP."/models/DAO/VendaDao.php";
        require_once PATH_APP."/models/DAO/PrecoProdutoDao.php";

        $statusVenda = new StatusVenda(null, "Ok");
        $data = (new DateTime())->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $venda = new Venda(null, $statusVenda, $this->getUsuarioLogado(), $data->format("Y-m-d H:i:s"));
        $precoProduto = (new PrecoProdutoDao())->buscar($_GET['id']);
        $itemVenda = new ItemVenda(null, $venda, $precoProduto, $_POST['quantidade']);
        try {
          (new VendaDao())->inserir($itemVenda);
          
          header("Location:".BASE_URL."/painel");
          return;
        } catch (Exception $ex) {
          $_SESSION['erro'] = $ex->getMessage();
        }
      } else {
        $_SESSION['erro'] = "Informe todos os campos obrigatórios";
      }
      header("Location:".BASE_URL."/produto/detalhar?id=".$_GET['id']);
    }
  }
}