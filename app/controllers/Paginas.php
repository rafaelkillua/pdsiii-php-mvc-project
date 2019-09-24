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
            if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
                if ($_POST['usuario'] == "pw" && $_POST['senha'] = "123") {
                    $this->logaUsuario("Paulo");
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
        if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
            if ($_POST['usuario'] == "pw" && $_POST['senha'] = "123") {
                $this->logaUsuario("Paulo");
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
    
    public function sair() {
        $this->deslogaUsuario();
        header("Location:".BASE_URL);
    }
    
}
