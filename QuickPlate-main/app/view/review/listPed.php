<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link href="../css/sticky-footer.css" rel="stylesheet">
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<script src="../js/status.js"></script>

<div class="container-fluid pb-5" style="margin-top: 150px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
        <?php
        require_once(__DIR__ . "/../include/menu.php");
        ?>
    </div>

    <!-- Texto -->
    <div class="container-fluid">

        <div class="text-lg-start text-muted">

            <div class="page-title mb-5">
                <h2><span>Histórico de Pedidos</h2>
            </div>

            <div class="row">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="statusOptions">Status</label>
                    </div>
                    <select class="custom-select" id="statusOptions" onchange="statusOptions('C')">
                        <option value="">Todos</option>
                        <option value="P" <?= ($dados["status"] == 'P' ? 'selected' : '') ?>>Processando</option>
                        <option value="PP" <?= ($dados["status"] == 'PP' ? 'selected' : '') ?>>Preparando</option>
                        <option value="C" <?= ($dados["status"] == 'C' ? 'selected' : '') ?>>Concluido</option>
                        <option value="E" <?= ($dados["status"] == 'E' ? 'selected' : '') ?>>Entregue</option>
                        <option value="CC" <?= ($dados["status"] == 'CC' ? 'selected' : '') ?>>Cancelado</option>
                    </select>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">

                    <?php foreach ($dados['listPed'] as $ped) : ?>

                        <div class="col-md-4">

                            <div class="card text-center">
                                <div class="card-header">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane<?= $ped->getIdPedido() ?>" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Dados do Pedido</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane<?= $ped->getIdPedido() ?>" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Itens do Pedido</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane<?= $ped->getIdPedido() ?>" role="tabpanel" aria-labelledby="home-tab" tabindex="0">  
                                            <h5 class="card-title">Dados do pedido: </h5>
                                            <span><b>Vendedor: </b></span><span><?= $ped->getNomeVendedor() ?> </span><br>
                                            <span><b>Status do Pedido: </b></span><span><?= $ped->getStatusDesc() ?></span><br>
                                            <span><b>Valor do Pedido: </b></span><span>R$<?= $ped->getPrecoPedidoFormatado() ?></span><br> 
                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane<?= $ped->getIdPedido() ?>" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                            <table id="tabUsuarios" class='table table-striped table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Produto</th>
                                                        <th>Categoria</th>
                                                        <th>Quantidade</th>
                                                        <th>Valor Unit.</th>
                                                        <th>Valor Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($ped->getItensPedido() as $item) :?>
                                                        <tr>
                                                            <td><?= $item->getProduto()->getNomeProduto(); ?></td>
                                                            <td><?= $item->getProduto()->getCategoriaDesc(); ?></td>
                                                            <td><?= $item->getQtd(); ?></td>
                                                            <td><?= $item->getValorFormatado(); ?></td>
                                                            <td><?= $item->getTotalFormatado(); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary-center">
                                        <?php if (!$ped->getReview()) : ?>
                                            <a class="btn btn-outline-success col-4 ml-3 mt-2" href="reviewController.php?action=formReview&idPedido=<?= $ped->getIdPedido(); ?>&idVendedor=<?= $ped->getIdVendedor(); ?>">Avaliar Pedido</a>
                                        <?php else : ?>
                                            Pedido já Avaliado
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div> <!-- /row2 -->
            </div> <!-- /row1 -->
        </div>
    </div>
    <!-- Botão de Voltar -->
    <div class="col-2" style="margin-left: 95%; margin-top: 0.5%">
        <a class="btn btn-success" href="homeController.php?action=homeCliente">Voltar</a>
    </div>
    <!--Footer-->
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>
</div>