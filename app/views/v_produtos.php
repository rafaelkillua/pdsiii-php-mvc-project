<div class="col-12 py-2">
  <table border="1">
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
<div class="col-12">
  <a href="<?=BASE_URL."/sair"?>" class="btn btn-danger">Sair</a>
</div>