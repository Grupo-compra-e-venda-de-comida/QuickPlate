<?php
require_once("../util/config.php");
include_once(__DIR__ . "/../include/header.php")
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../css/autoReg.css">
<link href="../css/estiloMenu2.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<div class="container-fluid pb-5" style="padding-top: 150px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
        <?php
        require_once(__DIR__ . "/../include/menu2.php");
        ?>
    </div>

    <div class="container-fluid">

        <main class="form-signin" style="top: 80%; left: 50%">
            <div class="text-lg-start text-muted">

                <div class="page-title">
                <h2><span>Editar Produto</span></h2>
                </div>
                <form method="POST" action="<?= BASEURL ?>/controller/produtoController.php?action=updateProd">

                    <div class="form mb-2 ">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= (isset($dados['produto']) ? $dados['produto']->getIdProduto() : ''); ?>" />
                    </div>

                    <div class="form mb-2 ">
                        <label for="nomeProduto">Titulo do Produto:</label>
                        <input type="text" class="form-control" placeholder="Titulo:" id="nomeProd" name="nomeProd" value="<?= (isset($dados['produto']) ? $dados['produto']->getNomeProduto() : ''); ?>" />
                    </div>

                    <div class="form mb-2 ">
                        <label for="precoProd">Preço:</label>
                        <input type="number" class="form-control" placeholder="Preço:" id="precoProd" name="precoProd" value="<?= (isset($dados['produto']) ? $dados['produto']->getPrecoProduto() : ''); ?>" />
                    </div>

                    <div class="form">
                        <label for="detalhes">Descrição do Produto:</label>
                        <input type="text" class="form-control" placeholder="Detalhes:" id="detalhes" name="detalhes" value="<?= (isset($dados['produto']) ? $dados['produto']->getDetalhes() : ''); ?>" />
                    </div>

                    <label class="selectlabel mb-2">Categoria</label>
                    <select class="select" id="catProd" name="catProd">
                        <option value="S" <?= ((isset($dados['produto']) && $dados['produto']->getCategoriaProduto() == 'S')  ? 'selected' : ''); ?>>Salgado</option>
                        <option value="D" <?= ((isset($dados['produto']) && $dados['produto']->getCategoriaProduto() == 'D')  ? 'selected' : ''); ?>>Doce</option>
                        <option value="B" <?= ((isset($dados['produto']) && $dados['produto']->getCategoriaProduto() == 'B')  ? 'selected' : ''); ?>>Bebida</option>
                    </select>

                    <input type="hidden" id="idVendedor" name="idVendedor" value="<?= $dados['idVendedor']; ?>" />

                    <button class="w-100 btn btn-lg btn-success mt-4 mb-2" type="submit">Atualizar</button>

                    <a href="../controller/homeController.php?action=homeVendedor" class="w-100 btn btn-lg btn-success">Voltar</a>
                </form>

                <?php include(__DIR__ . "/../include/msg.php"); ?>

            </div>
        </main>

    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>