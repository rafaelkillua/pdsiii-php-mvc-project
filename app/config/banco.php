<?php
require_once PATH_APP . "/models/DAO/Conexao.php";

$conexaoBanco = Conexao::getInstancia("db4free.net", "grafica", "rafaelkillua", "v2GH26pX4gdg9hL");
$conexaoBanco = $conexaoBanco->getConexao();