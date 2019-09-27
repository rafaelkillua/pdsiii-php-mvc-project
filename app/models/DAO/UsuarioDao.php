<?php
require_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/Usuario.php";

class UsuarioDao extends Dao {
  public static $v = 1;

  public function atualizar($obj) {}

  public function login($login, $senha) {
    $sql = "SELECT * FROM tb_usuario WHERE login = :login";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(":login", $login);
    $req->execute();

    if ($req->rowCount() == 0){
      return null; 
    }

    $result = $req->fetchAll();
    $r = $result[0];
    if (password_verify($senha, $r['senha'])) {
      return new Usuario($r['id'], $r['nome'], $r['login'], null, $r['tb_tipo_usuario_id']);
    }

    return null;
  }

  public function buscarTodos() {
    $sql_user = "SELECT id, nome, login FROM tb_usuario";
    $req = $this->pdo->prepare($sql_user);
    $req->execute();
    $usuarios = array();
    
    if ($req->rowCount() > 0){
      $result = $req->fetchAll();

      foreach ($result as $key => $value) {
        array_push($usuarios, new Usuario($value['id'], $value['nome'], $value['login']));
      }
    }
    return $usuarios;
  }

  public function excluir($id) {}

  public function buscar($id) {}

  public function inserir($usuario) {
    if (!$usuario || empty($usuario)){
      throw new Exception("Alguma coisa deu errado");
      return;
    }
    $sql_check = "SELECT login FROM tb_usuario WHERE login = ?";
    $req_check = $this->pdo->prepare($sql_check);
    $req_check->bindValue(1, $usuario->getLogin());
    $req_check->execute();
    if ($req_check->rowCount() > 0){
      throw new Exception("Usuário já tem cadastro");
      return;
    }

    $sql = "INSERT INTO tb_usuario (nome, login, senha) VALUES (:nome, :login, :senha)";
    $req = $this->pdo->prepare($sql);
    $req->bindValue(":nome", $usuario->getNome());
    $req->bindValue(":login", $usuario->getLogin());
    $req->bindValue(":senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
    $req->execute();
    if ($req->rowCount() == 0) {
      throw new Exception("Houve algum erro.");
    }
    return $this->pdo->lastInsertId();
  }
}
