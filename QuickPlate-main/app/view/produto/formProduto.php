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

  <h1 class="h3">Registrar Produto</h1>

  <form method="POST" action="<?= BASEURL ?>/controller/produtoController.php?action=createProd">

    <div class="form mb-2 ">
      <input type="text" class="form-control" placeholder="Titulo:" id="nomeProd" name="nomeProd" 
      value="<?= (isset($dados['produto']) ? $dados['produto']->getNomeProduto() : ''); ?>"/>
      <label for="nomeProduto"></label>
    </div>

    <div class="form mb-2 ">
      <input type="number" class="form-control" placeholder="Preço:" id="precoProd" name="precoProd" 
      value="<?= (isset($dados['produto']) ? $dados['produto']->getPrecoProduto() : ''); ?>"/>
      <label for="precoProd"></label>
    </div>

    <div class="form">
      <input type="text" class="form-control" placeholder="Detalhes:" id="detalhes" name="detalhes" 
      value="<?= (isset($dados['produto']) ? $dados['produto']->getDetalhes() : ''); ?>"/>
      <label for="detalhes"></label>
    </div>

    <label class="selectlabel mb-2">Categoria:</label>
    <select class="select" id="catProd" name="catProd">
      <option value="S" <?= ((isset($dados['produto']) && $dados['produto']->getCategoriaProduto() == 'S')  ? 'selected' : ''); ?> >Salgado</option>
      <option value="D" <?= ((isset($dados['produto']) && $dados['produto']->getCategoriaProduto() == 'D')  ? 'selected' : ''); ?>>Doce</option>
      <option value="B" <?= ((isset($dados['produto']) && $dados['produto']->getCategoriaProduto() == 'B')  ? 'selected' : ''); ?>>Bebida</option>
    </select>

    <input type="hidden" id="idVendedor" name="idVendedor" value="<?= $dados['idVendedor']; ?>" />

    <button class="w-100 btn btn-lg btn-outline-success mb-2 mt-2" type="submit">Registrar</button>
    <a href="../controller/homeController.php?action=homeVendedor" class="btn btn-primary mb-4">Voltar</a>
    
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