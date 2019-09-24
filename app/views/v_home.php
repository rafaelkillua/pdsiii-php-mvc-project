<div class="col-12 py-5 text-center">
  <form action="<?=BASE_URL."/entrar"?>" method="POST" class="col-6 mx-auto">
    <div class="form-group">
      <input type="text" name="login" class="form-control" autofocus placeholder="Usuário">
      <input type="password" name="senha" class="form-control" placeholder="Senha">
      <input type="submit" value="Entrar" class="btn btn-primary">
    </div>
    <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
  </form>
  <form action="<?=BASE_URL."/cadastro"?>" method="get">
    <input class="btn btn-secondary" type="submit" value="Cadastro">
  </form>
</div>