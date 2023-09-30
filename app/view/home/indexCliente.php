<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link href="../css/sticky-footer.css" rel="stylesheet">

<div class="container">

  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>
  </div>

  <!-- Texto -->
  <div class="container d-flex justify-content-center align-items-center col-md-4" style="position: absolute; top: 43%; left: 1%; font-size:25px">
    <div class="text">
      <p>

        Vendedores variados <br>
        Com o produto que <b>você</b> precisa <br>
        Faça seu pedido agora!

      </p>
    </div>
  </div>

  <!-- Carrossel -->
  <div class="container d-flex justify-content-center align-items-center" style="position: absolute; top: 500px; bottom: 400px; left: 1px; right: 1px; font-size:25px">
    <div id="carouselExample" class="carousel slide" style="left: 70%">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../view/img/chat.png" class="d-block w-10" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../view/img/chat.png" class="d-block w-10" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../view/img/chat.png" class="d-block w-10" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>

<!-- Linha Preta -->
<div id="linha-horizontal2" style=" position: absolute; width: 100%; border: 1px solid #000; bottom: 24%; left:0%"></div>

<!-- Botões de Vendedores -->
<div>
  <div class="text-lg-start bg-light text-muted" style="position: absolute; top:76%; width:100%; height:100%">

    <div style="margin: auto; text-align: center;" class="m-2">
      <h2>VENDEDORES</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($dados['listaVendedores'] as $vend) : ?>
        <div class="col">
          <div class="card h-100 w-100">
            <div class="card-body">
              <h4 class="card-title"><?= $vend->getNome() ?></h4>
              <p class="card-text">*avaliação</p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary-center"><a class="btn btn-outline-success col-4 ml-3 mt-2" href="pedidoController.php?action=listProdVend&idVendedor=<?= $vend->getIdVendedor(); ?>">Iniciar Pedido</a></small>              
              <!-- <small class="text-body-secondary-center"><a class="btn btn-outline-success col-4 ml-3 mt-2" href="reviewController.php?action=reviewVendedor&idVendedor=<?= $vend->getIdVendedor(); ?>">Avaliar Vendedor</a></small> -->
              <small class="text-body-secondary-center"><a class="btn btn-outline-success col-4 ml-3 mt-2" href="reviewController.php?action=formReview">Avaliar Vendedor</a></small>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!--Footer-->
  <?php
  require_once(__DIR__ . "/../include/footer.php");
  ?>

</div>