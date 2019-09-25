<div class="col-12 py-5 text-center">
  <form action="<?=BASE_URL."/cadastrar"?>" method="POST" class="col-6 mx-auto">
    <div class="form-group">
      <input type="text" name="nome" class="form-control" autofocus placeholder="Nome">
      <input type="text" name="login" class="form-control" placeholder="Usuário">
      <input type="password" name="senha" class="form-control" placeholder="Senha">
      <input type="password" name="confirmar-senha" class="form-control" placeholder="Confirmar senha">
      <a href="<?=BASE_URL."/"?>" class="btn btn-primary">Login</a>
      <input type="submit" value="Cadastrar" class="btn btn-success">
    </div>
    <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
  </form>
</div>