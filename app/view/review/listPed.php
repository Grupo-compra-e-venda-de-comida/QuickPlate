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
        <div class="col-12">
            <div style="margin: auto; text-align: center;" class="m-2">
                <h2>PEDIDOS</h2>
            </div>

            <?php 
                include_once(__DIR__ . "/../../dao/pedidoDAO.php");

                $pedidoDAO = new PedidoDAO();

                foreach ($dados["listPed"] as $ped) : 
                    $idPedido = $ped->getIdPedido();
                    $data = $pedidoDAO->joinPedidoItem($idPedido);
            ?>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($dados['listPed'] as $ped) : ?>
                    <div class="col">
                        <div class="card h-100 w-100">
                            <div class="card-body">
                                <h4 class="card-title"><?= $ped->getStatus() ?></h4>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary-center"><a class="btn btn-outline-success col-4 ml-3 mt-2" href="reviewController.php?action=formReview">Avaliar Vendedor</a></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> <!-- /row -->

    <div class="row">
        <div class="col-6">
            <a class="btn btn-success" href="homeController.php?action=homeCliente">Voltar</a>
        </div>
    </div>

    <!--Footer-->
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>

</div>