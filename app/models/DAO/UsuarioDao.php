<?php
require_once PATH_APP."/models/DAO/Dao.php";
require_once PATH_APP."/models/Dados/Usuario.php";

class UsuarioDao extends Dao {
  public static $v = 1;

  public function atualizar($obj) {}

  public function login($login, $senha) {
    try {
      $sql = "SELECT * FROM tb_usuario WHERE login = :login AND senha = :senha";
      $req = $this->pdo->prepare($sql);
      $req->bindValue(":login", $login);
      $req->bindValue(":senha", $senha);
      $req->execute();

      if ($req->rowCount() == 0){
        return null; 
      }

      $result = $req->fetchAll();
      $r = $result[0];

      return new Usuario($r['id'], $r['nome'], $r['tb_tipo_usuario_id'], $r['login'], $r['senha']);
    } catch (Exception $ex) {
      echo "ERRO USUARIODAO: ".$ex->getMessage();
    }
  }

  public function buscarTodos() {
    try {
      $sql_user = "SELECT id, nome, login as l FROM tb_usuario";
      $req = $this->pdo->prepare($sql_user);
      $req->execute();
      
      if($req->rowCount() > 0){
        $result = $req->fetchAll();
        $usuarios = array();

        foreach ($result as $key => $value) {
          array_push($usuarios, new Usuario($value['id'], $value['nome'], null,  $value['l'], null, null));
        }
      } else {
        echo "Não há usuários";
      }
      return $usuarios;
    } catch (PDOException $e) {
      $e->getMessage();
    }
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
    var_dump($req_check->fetchAll());
    if ($req_check->rowCount() > 0){
      throw new Exception("Usuário já tem cadastro");
      return;
    }

    $sql = "INSERT INTO tb_usuario (nome, login, senha) VALUES (?,?,?)";
    $req->bindValue(1, $usuario->getNome());
    $req->bindValue(2, $usuario->getLogin());
    $req->bindValue(3, $usuario->getSenha());
    $req = $this->pdo->prepare($sql);
    $req->execute();
  }
}
