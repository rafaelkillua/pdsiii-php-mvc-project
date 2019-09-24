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
  
  public function listar() {
    if (!$this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      $this->carregarDAO("ProdutoDao");

      $produtos = (new ProdutoDao())->buscarTodos();

      $this->addDadosPagina("produtos", $produtos);
      $this->addDadosPagina("nomeUsuario", "PAulo Weverton");
      $this->carregarView("v_produtos");

      //echo "<pre>".print_r($produtos, true)."</pre>";
    }
  }
  
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
  
  public function sobre() {
    echo __FUNCTION__;
  }
  
  public function erro404() {
    echo "PAGINA NÃO ENCONTRADA";
  }
  
  public function entrar() {
    if ($this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      if (!empty($_POST['login']) && !empty($_POST['senha'])) {
        require_once PATH_APP."/models/DAO/UsuarioDao.php";

        $usuario = (new UsuarioDao())->login($_POST['login'], $_POST['senha']);
        if (!empty($usuario)) {
          $this->logaUsuario($usuario->getLogin());
          header("Location:".BASE_URL."/produtos");
          return;
        } else {
          $_SESSION['erro'] = "Login ou senha incorreta";
        }
      } else {
        $_SESSION['erro'] = "Informe todos os campos obrigatórios";
      }
      header("Location:".BASE_URL);
    }
  }

  public function cadastrar() {
    if (!empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['confirmar-senha']) && !empty($_POST['nome'])) {
      if ($_POST['senha'] == $_POST['confirmar-senha']) {
        require_once PATH_APP."/models/Dados/Usuario.php";
        require_once PATH_APP."/models/DAO/UsuarioDao.php";

        $usuario = new Usuario(null, $_POST['nome'], null, $_POST['login'], $_POST['senha']);
        try {
          (new UsuarioDao())->inserir($usuario);
          $this->logaUsuario($usuario->getLogin());
          header("Location:".BASE_URL."/produtos");
          return;
        } catch (Exception $ex) {
          $_SESSION['erro'] = $ex->getMessage();
        }
      } else {
        $_SESSION['erro'] = "As senhas não conferem";
      }
    } else {
      $_SESSION['erro'] = "Informe todos os campos obrigatórios";
    }
    header("Location:".BASE_URL."/cadastro");
  }
  
  public function sair() {
    $this->deslogaUsuario();
    header("Location:".BASE_URL);
  }
  
}
