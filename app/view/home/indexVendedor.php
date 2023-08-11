<link rel="stylesheet" type="text/css" href="../view/home/estiloVendedor.css">

<?php
require_once(__DIR__ . "/../include/header.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" type="text/css" href="../css/estiloMenu.css">
<div class="container">
  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu2.php");
    ?>
  </div>
</div>
<div>
  <div class="container d-flex justify-content-center col-md-4" style="position: absolute;top: 40%; left: 33%; font-size:25px">

    <a href="../controller/produtoController.php?action=formProd" class="btn btn-outline-success">Cadastre Produto</a>

  </div>
  <div class="container d-flex justify-content-center col-md-4" style="position: absolute;top: 50%; left: 33%; font-size:25px">

    <a href="../controller/produtoController.php?action=listProd" class="btn btn-outline-success">Seus Produtos</a>

  </div>
</div>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>