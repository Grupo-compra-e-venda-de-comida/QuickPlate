<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link href="../css/sticky-footer.css" rel="stylesheet">

<div class="container-fluid pb-5" style="margin-top: 270px; margin-bottom: 75px;">


  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>
  </div>

  <!-- Texto -->
  <div class="row">
    <div class="col-6">
      <p>

        Vendedores variados <br>
        Com o produto que <b>você</b> precisa <br>
        Faça seu pedido agora!

      </p>
    </div>

  <div class="row">
    <div class="col-6">
      <a class="btn btn-success" href="pedidoController.php?action=listPedCliente">Pedidos</a>
    </div>
  </div>

  <!-- Linha Preta -->
  <div id="linha-horizontal2" style=" position: absolute; width: 100%; border: 1px solid #000; bottom: 24%; left:0px"></div>

  <!-- Botões de Vendedores -->
  <div>
    <div class="text-lg-start bg-light text-muted" style="position: absolute; top:76%; width:100%; height:100%; left:1px">

      <div style="margin: auto; text-align: center;" class="m-2">
        <h2>VENDEDORES</h2>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-right: 0px; margin-left: 1px">
        <?php foreach ($dados['listaVendedores'] as $vend) : ?>
          <div class="col">
            <div class="card h-100 w-100" style="background: #f8f9fa;">
              <div class="card-body">
                <h4 class="card-title"><?= $vend->getNome() ?></h4>
                <p class="card-text">Avaliação</p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary-center"><a class="btn btn-outline-success col-4 ml-3 mt-2" href="pedidoController.php?action=listProdVend&idVendedor=<?= $vend->getIdVendedor(); ?>">Iniciar Pedido</a></small>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!--Footer-->
  <?php
  require_once(__DIR__ . "/../include/footer.php");
  ?>

</div>