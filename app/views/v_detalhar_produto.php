<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Produtos</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="col-12">
            <?php
            //echo "<pre>".print_r($dados, true)."</pre>";
                if (!empty($dados["produto"])) {
                    var_dump($dados["produto"]);
                }
            ?>
        </div>
        <div class="col-12"><a href="<?=BASE_URL."/produtos"?>" class="btn btn-primary">Voltar</a></div>
    </body>
</html>