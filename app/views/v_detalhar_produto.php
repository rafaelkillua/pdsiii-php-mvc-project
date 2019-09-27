<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Produtos</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div class="col-12 d-flex flex-column align-items-center">
      <?php
        if (!empty($dados["produto"])) {
          $precoProduto = $dados["produto"]; ?>
          <p><strong>ID Produto: </strong><?=$precoProduto->getProduto()->getId()?></p>
          <p><strong>Nome: </strong><?=$precoProduto->getProduto()->getNome()?></p>
          <p><strong>Preço de compra: </strong><?=$precoProduto->getPrecoCompra()?></p>
          <p><strong>Preço de venda: </strong><?=$precoProduto->getPrecoVenda()?></p>
          <p><strong>Quantidade: </strong><?=$precoProduto->getQuantidade()?></p>
          <p><strong>Status: </strong><?=$precoProduto->getStatus() == 1 ? "Ativo" : "Inativo"?></p>
        <?php }
      ?>
      <a href="<?=BASE_URL."/produtos"?>" class="btn btn-primary">Voltar</a>
    </div>
  </body>
</html>