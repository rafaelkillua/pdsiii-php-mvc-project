<?php
require_once PATH_APP . "/models/DAO/Conexao.php";

$conexaoBanco = Conexao::getInstancia("localhost", "projeto-mvc", "root", "");
$conexaoBanco = $conexaoBanco->getConexao();