<?php
require_once PATH_APP."/controllers/ControladorCore.php";

class AcoesHome extends ControladorCore {
  
  public function entrar() {
    if ($this->estaLogado()) {
      header("Location:".BASE_URL);
    } else {
      if (!empty($_POST['login']) && !empty($_POST['senha'])) {
        require_once PATH_APP."/models/DAO/UsuarioDao.php";
        try {
          $usuario = (new UsuarioDao())->login($_POST['login'], $_POST['senha']);
          if (!empty($usuario)) {
            $this->logaUsuario($usuario);
            header("Location:".BASE_URL."/produtos");
            return;
          } else {
            $_SESSION['erro'] = "Login ou senha incorreta";
          }
        } catch (Exception $ex) {
          $_SESSION['erro'] = $ex->getMessage();
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

        $usuario = new Usuario(null, $_POST['nome'], $_POST['login'], $_POST['senha']);
        try {
          $id = (new UsuarioDao())->inserir($usuario);
          $usuario->setId($id);
          $this->logaUsuario($usuario);
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
