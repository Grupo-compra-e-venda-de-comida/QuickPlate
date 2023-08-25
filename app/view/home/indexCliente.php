<?php 
    require_once(__DIR__ . "/../include/header.php");
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" type="text/css" href="../css/estiloMenu.css">
<link href="../css/sticky-footer.css" rel="stylesheet">

<div class="container">
  <!-- Navbar -->
  <div class="row">
      <?php 
          require_once(__DIR__ . "/../include/menu.php"); 
      ?>
      
  </div>  
  <!-- Texto com botão de iniciar pedido {}-->
  <div class="container d-flex justify-content-center align-items-center col-md-4" style="position: absolute; top: 500px; bottom: 400px; left: 1%; font-size:25px">
    <div class="text">
      <p>

        Vendedores variados <br>
        Com o produto que <b>você</b> precisa <br>
        Faça seu pedido agora!

        </p>
    </div>
  </div>
  
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
    <div id="linha-horizontal2" style=" position: absolute; width: 100%; border: 1px solid #000; top: 75%; left:0%">
</div>
<div>

<div class="text-center text-lg-start bg-light text-muted " style="position: absolute; top:76%; width:100%; height:100%">
  <h1>Teste</h1>
  <?php foreach($dados['listaVendedores'] as $vend): ?>
    <div>
      <a href="pedidoController.php?action=listProdVend&idVendedor=<?= $vend->getIdVendedor(); ?>" > <?= $vend->getNome(); ?></a>
    </div>

  <?php endforeach; ?>

</div>

<!--Footer-->
<?php  
    require_once(__DIR__ . "/../include/footer.php");
?>
</div>