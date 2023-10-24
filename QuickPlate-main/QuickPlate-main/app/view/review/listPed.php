<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link href="../css/sticky-footer.css" rel="stylesheet">

<script src="../js/status.js"></script>

<div class="container-fluid pb-5" style="margin-top: 270px; margin-bottom: 75px;">
    <div class="row">

        <!-- Navbar -->
        <div class="row">
            <?php require_once(__DIR__ . "/../include/menu.php"); ?>
        </div>

        <!-- Texto -->
        <div class="row">
            <div class="col-12">
                <div style="margin: auto; text-align: center;" class="m-2">
                    <h2>PEDIDOS</h2>
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="statusOptions">Status</label>
                    </div>
                    <select class="custom-select" id="statusOptions" onchange="statusOptions()">
                        <option selected>Todos</option>
                        <option value="P">Processando</option>
                        <option value="PP">Preparando</option>
                        <option value="C">Concluido</option>
                        <option value="E">Entregue</option>
                        <option value="CC">Cancelado</option>
                    </select>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                    <?php foreach ($dados['listPed'] as $ped) : ?>
                        <div class="col">
                            <div class="card text-center h-100 w-100 mr-2">
                                <div class="card-header">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#name<?= $ped->getIdPedido() ?>" role="tab" data-toggle="tab">Dados do Pedido</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#itens<?= $ped->getIdPedido() ?>" role="tab" data-toggle="tab">Itens</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="name<?= $ped->getIdPedido() ?>">
                                            <h5 class="card-title">Dados do pedido: </h5>
                                            <span>Vendedor: </span><span><?= $ped->getNomeVendedor() ?> </span><br>
                                            <span>Status do Pedido: </span><span><?= $ped->getStatusDesc() ?></span><br>
                                            <span>Valor do Pedido: </span><span>R$<?= $ped->getPrecoPedidoFormatado() ?></span><br>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="itens<?= $ped->getIdPedido() ?>">

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
                                                    <?php
                                                    foreach ($ped->getItensPedido() as $item) :
                                                    ?>
                                                        <tr>
                                                            <td><?= $item->getProduto()->getNomeProduto(); ?></td>
                                                            <td><?= $item->getProduto()->getCategoriaDesc(); ?></td>
                                                            <td><?= $item->getQtd(); ?></td>
                                                            <td><?= $item->getValorFormatado(); ?></td>
                                                            <td><?= $item->getTotal(); ?></td>
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
                                            <a class="btn btn-outline-success col-4 ml-3 mt-2" href="reviewController.php?action=formReview&idPedido=<?= $ped->getIdPedido(); ?>">Avaliar Pedido</a>

                                        <?php else : ?>
                                            pedido já avaliado
                                        <?php endif; ?>

                                    </small>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div> <!-- /row2 -->
    </div> <!-- /row1 -->



    <!-- Botão de Voltar -->
    <div class="col-2" style="margin-left: 95%; margin-top: 0.5%">
        <a class="btn btn-success" href="homeController.php?action=homeCliente">Voltar</a>
    </div>



    <!--Footer-->
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>

</div>