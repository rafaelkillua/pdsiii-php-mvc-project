<div class="col-12 py-2 px-5 d-flex">
  <div class="col-6">
    <h3>Lista de produtos</h3>
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
  <div class="col-6">
    <h3>Suas compras</h3>
    <table class="table">
      <tr>
        <th>COD</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor</th>
        <th>Data</th>
        <th>Status</th>
      </tr>
      <?php
      // echo "<pre>".print_r($dados['vendas'], true)."</pre>";
      foreach ($dados["vendas"] as $v):?>
        <tr>
          <td><?=$v->getVenda()->getId();?></td>
          <td><?=$v->getPrecoProduto()->getProduto()->getNome();?></td>
          <td><?=$v->getQuantidade();?></td>
          <td><?=$v->getPrecoProduto()->getPrecoVenda()*$v->getQuantidade();?></td>
          <td><?=$v->getVenda()->getData();?></td>
          <td><?=$v->getVenda()->getStatusVenda()->getNome();?></td>
        </tr>
      <?php
      endforeach;?>
    </table>
  </div>
</div>
<div class="col-12 d-flex justify-content-center">
  <a href="<?=BASE_URL."/sair"?>" class="btn btn-danger">Sair</a>
  <a href="<?=BASE_URL."/produto/novo"?>" class="btn btn-primary ml-1">Cadastrar Produto</a>
</div>