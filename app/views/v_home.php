<div class="col-12 py-5 text-center">
  <form action="<?=BASE_URL."/entrar"?>" method="POST" class="col-6 mx-auto">
    <div class="form-group">
      <input type="text" name="login" class="form-control" autofocus placeholder="Usuário">
      <input type="password" name="senha" class="form-control" placeholder="Senha">
      <a href="<?=BASE_URL."/cadastro"?>" class="btn btn-primary">Cadastro</a>
      <input type="submit" value="Entrar" class="btn btn-success">
    </div>
    <?php echo isset($_SESSION["erro"]) ? $_SESSION["erro"] : ""?>
  </form>
</div>