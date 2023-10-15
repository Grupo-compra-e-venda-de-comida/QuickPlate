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

    <h1 class="h3">Editar Produto</h1>

    <form method="POST" action="<?= BASEURL ?>/controller/produtoController.php?action=updateProd">

        <div class="form-floating mb-2 ">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo (isset($dados['produto']) ? $dados['produto']->getIdProduto() : ''); ?>" />
            <label for="nome">ID</label>
        </div>

        <div class="form-floating mb-2 ">
            <input type="text" class="form-control" id="nomeProd" name="nomeProd" value="<?php echo (isset($dados['produto']) ? $dados['produto']->getNomeProduto() : ''); ?>" />
            <label for="nomeProduto">Titulo do Produto</label>
        </div>

        <div class="form-floating mb-2 ">
            <input type="number" class="form-control" id="precoProd" name="precoProd" value="<?php echo (isset($dados['produto']) ? $dados['produto']->getPrecoProduto() : ''); ?>" />
            <label for="precoProd">Preço:</label>
        </div>

        <div class="form-floating">
            <input type="text" class="form-control" id="detalhes" name="detalhes" value="<?php echo (isset($dados['produto']) ? $dados['produto']->getDetalhes() : ''); ?>" />
            <label for="detalhes">Descrição do Produro</label>
        </div>

        <label class="selectlabel mb-2">Categoria</label>
        <select class="select" id="catProd" name="catProd">
            <option value="S">Salgado</option>
            <option value="D">Doce</option>
            <option value="B">Bebida</option>
        </select>

        <input type="hidden" id="idVendedor" name="idVendedor" value="<?php echo $dados['idVendedor']; ?>" />

        <button class="w-100 btn btn-lg btn-outline-success mt-2 mb-2" type="submit">Atualizar</button>

        <a href="../controller/homeController.php?action=homeVendedor" class="btn btn-success">Voltar</a>
    </form>



</main>
</form>

<?php //include(__DIR__ . "/../include/msg.php"); 
?>
</div>

</div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>