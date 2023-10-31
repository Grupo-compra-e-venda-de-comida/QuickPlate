<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="../css/sticky-footer.css" rel="stylesheet">
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<div class="container-fluid pb-5" style="padding-top: 120px; margin-bottom: 75px;">

  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>
  </div>

  <div class="container-fluid">

    <!-- Card de Vendedores -->
    <div class="text-lg-start text-muted">

      <div class="page-title m-4">
        <h2><span>Selecione seus</span> Vendedores</h2>
      </div>

      <div class="row">
        <?php foreach ($dados['listaVendedores'] as $vend) : ?>

          <div class="col-md-3">
            
            <div class="card mb-3" style="background: #f8f9fa;">
              <div class="card-body">
                <h4 class="card-title"><?= $vend->getNome() ?></h4>
                <p class="card-text">Avaliação</p>

                <div id="rating" class="star-rating">

                  <!-- ALTERAR O VALOR 3 PARA A VARIÁVEL DE AVALIAÇÃO DO VENDEDOR -->
                  <?php for ($i = 0; $i < 3; $i++) : ?>
                    <span class="rating-star">&#9733;</span>
                  <?php endfor; ?>
                </div>


              </div>
              <div class="card-footer">
                <small class="text-body-secondary-center"><a class="btn btn-outline-success" href="pedidoController.php?action=listProdVend&idVendedor=<?= $vend->getIdVendedor(); ?>">Iniciar Pedido</a></small>
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