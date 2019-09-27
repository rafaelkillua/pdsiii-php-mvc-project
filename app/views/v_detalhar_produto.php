<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Produtos</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div class="col-12 d-flex flex-column align-items-center">
      <?php
        if (!empty($dados["produto"])) { ?>
          <p><strong>ID Produto: </strong><?=$dados["produto"]->getProduto()->getId()?></p>
          <p><strong>Nome: </strong><?=$dados["produto"]->getProduto()->getNome()?></p>
          <p><strong>Preço de compra: </strong><?=$dados["produto"]->getPrecoCompra()?></p>
          <p><strong>Preço de venda: </strong><?=$dados["produto"]->getPrecoVenda()?></p>
          <p><strong>Quantidade: </strong><?=$dados["produto"]->getQuantidade()?></p>
          <p><strong>Status: </strong><?=$dados["produto"]->getStatus() == 1 ? "Ativo" : "Inativo"?></p>
        <?php }
      ?>
      <a href="<?=BASE_URL."/produtos"?>" class="btn btn-primary">Voltar</a>
    </div>
  </body>
</html>