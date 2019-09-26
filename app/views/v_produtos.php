<div class="col-12 py-2 px-5">
  <table class="table">
    <tr>
      <th>COD</th>
      <th>Nome Produto</th>
      <th>-</th>
    </tr>
    <?php
    //echo "<pre>".print_r($dados, true)."</pre>";
    foreach ($dados["produtos"] as $p):?>
      <tr>
        <td><?=$p->getId();?></td>
        <td><?=$p->getNome();?></td>
        <td><a href="<?=BASE_URL."/produto/detalhar?id=".$p->getId()?>">Detalhar</a></td>
      </tr>
    <?php
    endforeach;?>
  </table>
</div>
<div class="col-12 d-flex justify-content-center">
  <a href="<?=BASE_URL."/sair"?>" class="btn btn-danger">Sair</a>
  <a href="<?=BASE_URL."/produto/novo"?>" class="btn btn-primary">Cadastrar Produto</a>
</div>