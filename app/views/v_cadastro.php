<div class="col-12 py-5 text-center">
  <form action="<?=BASE_URL."/cadastrar"?>" method="POST" class="col-6 mx-auto">
    <div class="form-group">
      <input type="text" name="nome" class="form-control" autofocus placeholder="Nome">
      <input type="text" name="login" class="form-control" placeholder="Usuário">
      <input type="password" name="senha" class="form-control" placeholder="Senha">
      <input type="password" name="confirmar-senha" class="form-control" placeholder="Confirmar senha">
      <input type="submit" value="Cadastrar" class="btn btn-primary">
    </div>
    <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
  </form>
  <form action="<?=BASE_URL."/"?>" method="GET" class="col-6 mx-auto">
    <input class="btn btn-secondary" type="submit" value="Fazer login">
  </form>
</div>