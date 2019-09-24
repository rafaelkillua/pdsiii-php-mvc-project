<?php

$rotas[""] = array("rota"=>"/", "controller"=>"Paginas", "acao"=>"index");
$rotas["home"] = array("rota"=>"/home", "controller"=>"Paginas", "acao"=>"index");
$rotas["cadastro"] = array("rota"=>"/cadastro", "controller"=>"Paginas", "acao"=>"cadastro");
$rotas["sobre"] = array("rota"=>"/sobre", "controller"=>"Paginas", "acao"=>"sobre");
$rotas["entrar"] = array("rota"=>"/entrar", "controller"=>"Paginas", "acao"=>"entrar");
$rotas["cadastrar"] = array("rota"=>"/cadastro", "controller"=>"Paginas", "acao"=>"cadastrar");
$rotas["sair"] = array("rota"=>"/sair", "controller"=>"Paginas", "acao"=>"sair");

$rotas["produtos"] = array("rota"=>"/produtos", "controller"=>"Paginas", "acao"=>"listar");
$rotas["produto/detalhar"] = array("rota"=>"/produto/detalhar", "controller"=>"Paginas", "acao"=>"detalharProduto");

$rotas["produtos/listar"] = array("rota"=>"/produtos/listar", "controller"=>"Paginas", "acao"=>"sobre");
$rotas["asdf"] = array("rota"=>"/asdf", "controller"=>"admin", "acao"=>"asdf");

//echo "<pre>".print_r($rotas, true)."</pre>";