<?php
require_once PATH_APP . "/models/DAO/Conexao.php";

$conexaoBanco = Conexao::getInstancia("db4free.net", "grafica", "rafaelkillua", "299792458");
$conexaoBanco = $conexaoBanco->getConexao();