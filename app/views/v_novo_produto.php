<div class="col-12 py-5 text-center">
  <form action="<?=BASE_URL."/produto/cadastrar"?>" method="POST" class="col-6 mx-auto">
    <div class="form-group">
      <input type="text" name="nome" class="form-control" autofocus placeholder="Nome" required>
      <input type="text" name="preco_compra" class="form-control" type="number" step="0.01" placeholder="Preço de Compra" min="0" max="999.99" required>
      <input type="text" name="preco_venda" class="form-control" type="number" step="0.01" placeholder="Preço de Venda" min="0" max="999.99" required>
      <input type="text" name="quantidade" class="form-control" type="number" step="1" placeholder="Quantidade" required>
      <a href="<?=BASE_URL."/"?>" class="btn btn-secondary">Voltar</a>
      <button class="btn btn-success" type="submit">Cadastrar Novo Produto</button>
    </div>
    <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
  </form>
</div>