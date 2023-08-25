<link rel="stylesheet" type="text/css" href="../view/home/estiloVendedor.css">

<?php
require_once(__DIR__ . "/../include/header.php");
//require_once(__DIR__ . "/../../controller/produtoController.php");
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

<!--Linha Preta-->
<div style="position: absolute; top: 295px; color:black; width:100%; border: 1px solid; right: 0%;"></div>

<div class="container">

  <div class="container d-flex justify-content-left col-md-4" style="position: absolute;top: 45%; left: 20%; font-size:25px">

    <a href="../controller/produtoController.php?action=formProd" class="btn btn-outline-success">Cadastre Produto</a>

  </div>
  <div class="container d-flex justify-content-left col-md-4" style="position: absolute;top: 55%; left: 20%; font-size:25px">

    <a href="../controller/produtoController.php?action=listProd" class="btn btn-outline-success">Editar Produtos</a>

  </div>
  <div class="container d-flex justify-content-left col-md-4" style="position: absolute;top: 65%; left: 20%; font-size:25px">

    <a href="../controller/produtoController.php?action=listProd" class="btn btn-outline-success">Minhas Vendas</a>

  </div>
  <div class="container d-flex justify-content-left col-md-4" style="position: absolute;top: 33%; left: 70%; font-size:25px">

    <h2>Meus Produtos</h2>

    <div class="row mt-5" style="position:absolute;">
      <div class="col">
        <table id="tabUsuarios" class='table table-striped table-bordered'>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Categorias</th>
              <th>Detalhes</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </tr>
          </thead>

        </table>
      </div>
    </div>
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>