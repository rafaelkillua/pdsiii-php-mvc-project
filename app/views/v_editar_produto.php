<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Editar Produto</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div class="col-12 d-flex flex-column align-items-center">
      <?php
        if (!empty($dados["produto"])) {
          $precoProduto = $dados["produto"]; ?>
          <form action="<?=BASE_URL."/produto/editarProduto"?>" method="POST">
            <input class="d-none" name="id" value="<?=$precoProduto->getId()?>">
            <div class="mb-2">
              <label for="id_produto"><strong>ID do Produto:</strong></label>
              <input id="id_produto" name="id_produto" disabled class="form-control" value="<?=$precoProduto->getProduto()->getId()?>">
            </div>
            <div class="mb-2">
              <label for="nome"><strong>Nome:</strong></label>
              <input id="nome" name="nome" disabled class="form-control" value="<?=$precoProduto->getProduto()->getNome()?>">
            </div>
            <div class="mb-2">
              <label for="precoCompra"><strong>Preço de compra:</strong></label>
              <input id="precoCompra" name="precoCompra" class="form-control" value="<?=$precoProduto->getPrecoCompra()?>">
            </div>
            <div class="mb-2">
              <label for="precoVenda"><strong>Preço de venda:</strong></label>
              <input id="precoVenda" name="precoVenda" class="form-control" value="<?=$precoProduto->getPrecoVenda()?>">
            </div>
            <div class="mb-2">
              <label for="quantidade"><strong>Quantidade:</strong></label>
              <input id="quantidade" name="quantidade" class="form-control" value="<?=$precoProduto->getQuantidade()?>">
            </div>
            <div class="d-flex justify-content-center mt-4">
              <a href="<?=BASE_URL."/produto/detalhar?id=".$_GET["id"]?>" class="btn btn-primary">Voltar</a>
              <button class="btn btn-success ml-1" type="submit">Editar</button>
            </div>
          </form>
        <?php }
      ?>
      <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
    </div>
  </body>
</html>