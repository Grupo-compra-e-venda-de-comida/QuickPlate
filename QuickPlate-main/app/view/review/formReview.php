<?php
require_once("../util/config.php");
include_once(__DIR__ . "/../include/header.php")
?>

<link href="../css/sticky-footer.css" rel="stylesheet">
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/autoReg.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<div class="container-fluid pb-5" style="padding-top: 150px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
    <?php require_once(__DIR__ . "/../include/menu.php"); ?>
    </div>

    <div class="container-fluid">

        <main class="form-signin" style="top: 80%; left: 50%;">


                    <?= $dados['pedido']->getNomeVendedor() ?>
                    <?= $dados['pedido']->getPrecoPedidoFormatado() ?>
                
                    <h3 style="font-size: 25px">Avaliar Pedido</h3>
                
                
                    <form method="POST" action="<?= BASEURL ?>/controller/reviewController.php?action=createReview">
                        <div class="form mb-2">
                            <input type="hidden" class="form-control" id="idPedido" name="idPedido" readonly value="<?= $dados['pedido']->getIdPedido() ?>" />
                        </div>

                        <div class="form mb-2">
                            <input type="hidden" class="form-control" id="idVendedor" name="idVendedor" readonly value="<?= $dados['pedido']->getIdVendedor() ?>" />
                        </div>
                                        
                        <div class="form mb-2">
                            <input type="number" min="1" max="5" class="form-control" id="avaliacao" name="avaliacao" placeholder="Avaliação:" value="<?= (isset($dados['review']) ? $dados['review']->getAvaliacao() : ''); ?>" />
                            <label class="form-label" for="avaliacao"></label>
                        </div>

                        <div class="form">
                            <input type="text" maxlength="150" class="form-control" id="comentario" name="comentario" placeholder="Comentário:" value="<?= (isset($dados['review']) ? $dados['review']->getComentario() : ''); ?>" />
                            <label class="form-label" for="comentario"></label>
                        </div>

                        <button class="w-100 btn btn-lg btn-success mb-2 mt-2" type="submit">Registrar</button>
                        <a href="../controller/homeController.php?action=homeCliente" class="w-100 btn btn-lg btn-success">Voltar</a>

                        <?php
                        include(__DIR__ . "/../include/msg.php");
                        ?>
                    </form>
                
                
            </div>
        </main>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>