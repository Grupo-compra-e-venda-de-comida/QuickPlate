<?php
require_once("../util/config.php");
include_once(__DIR__ . "/../include/header.php")
?>

<div class="col-4">
    <img src="../view/img/logo.png" class="logo" alt="logo">
</div>

<link rel="stylesheet" type="text/css" href="../css/autoReg.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<div class="bg">

</div>

<main class="form-signin">

    <h1 class="h3">Avaliar Vendedor</h1>

    <form method="POST" action="<?= BASEURL ?>/controller/reviewController.php?action=createReview">

        <div class="form-floating mb-2">
            <input type="number" min="1" max="5" class="form-control" id="avaliacao" name="avaliacao" value="<?php echo (isset($dados['review']) ? $dados['review']->getAvaliacao() : ''); ?>" />
            <label for="avaliacao">Avaliação: </label>
        </div>

        <div class="form-floating">
            <input type="text" maxlength="150" class="form-control" id="comentario" name="comentario" value="<?php echo (isset($dados['comentario']) ? $dados['comentario']->getComentario() : ''); ?>" />
            <label for="comentario">Comentário: </label>
        </div>

        <button class="w-100 btn btn-lg btn-outline-success mb-2 mt-2" type="submit">Registrar</button>
        <a href="../controller/homeController.php?action=homeCliente" class="btn btn-primary mb-4">Voltar</a>

        <?php
        include(__DIR__ . "/../include/msg.php");
        ?>
    </form>

</main>


</div>

</div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>