<?php

// HOME GET
$rotas[""] = array("rota"=>"/", "controller"=>"Paginas", "acao"=>"index");
$rotas["home"] = array("rota"=>"/home", "controller"=>"Paginas", "acao"=>"index");
$rotas["cadastro"] = array("rota"=>"/cadastro", "controller"=>"Paginas", "acao"=>"cadastro");
$rotas["sobre"] = array("rota"=>"/sobre", "controller"=>"Paginas", "acao"=>"sobre");

// HOME POST
$rotas["entrar"] = array("rota"=>"/entrar", "controller"=>"AcoesHome", "acao"=>"entrar");
$rotas["cadastrar"] = array("rota"=>"/cadastrar", "controller"=>"AcoesHome", "acao"=>"cadastrar");
$rotas["sair"] = array("rota"=>"/sair", "controller"=>"AcoesHome", "acao"=>"sair");

// PRODUTOS GET
$rotas["produtos"] = array("rota"=>"/painel", "controller"=>"Paginas", "acao"=>"painel");
$rotas["produto/detalhar"] = array("rota"=>"/produto/detalhar", "controller"=>"Paginas", "acao"=>"detalharProduto");
$rotas["produto/novo"] = array("rota"=>"/produto/novo", "controller"=>"Paginas", "acao"=>"novoProduto");

// PRODUTOS POST
$rotas["produto/cadastrar"] = array("rota"=>"/produto/cadastrar", "controller"=>"AcoesProduto", "acao"=>"cadastrarProduto");

// VENDAS POST
$rotas["produto/comprar"] = array("rota"=>"/produto/comprar", "controller"=>"AcoesVenda", "acao"=>"cadastrarVenda");

//echo "<pre>".print_r($rotas, true)."</pre>";