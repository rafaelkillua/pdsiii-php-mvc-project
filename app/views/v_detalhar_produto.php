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
      <form class="w-50 d-flex" action="<?=BASE_URL."/produto/comprar?id=".$precoProduto->getProduto()->getId()?>" method="POST">
        <input class="flex-grow-1 mr-2" name="quantidade" placeholder="Quantidade a comprar" type="number" step="1" min="0" max="<?=$precoProduto->getQuantidade()?>" <?=$precoProduto->getQuantidade() < 1 ? 'disabled' : ''?>>
        <button class="btn btn-success" type="submit">Comprar</button>
      </form>
      <a href="<?=BASE_URL."/produtos"?>" class="btn btn-primary">Voltar</a>
      <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
    </div>
  </body>
</html>