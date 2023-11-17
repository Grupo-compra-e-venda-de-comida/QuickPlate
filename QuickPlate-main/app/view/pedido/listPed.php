<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link href="../css/sticky-footer.css" rel="stylesheet">

<script src="../js/status.js"></script>

<div class="container-fluid pb-5" style="margin-top: 270px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
        <?php
        require_once(__DIR__ . "/../include/menu2.php");
        ?>
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
                    <select class="custom-select" id="statusOptions" onchange="statusOptions('V')">
                        <option value="" >Todos</option>
                        <option value="P" <?= ($dados["status"] == 'P' ? 'selected' : '') ?>>Processando</option>
                        <option value="PP" <?= ($dados["status"] == 'PP' ? 'selected' : '') ?>>Preparando</option>
                        <option value="C" <?= ($dados["status"] == 'C' ? 'selected' : '') ?>>Concluido</option>
                        <option value="E" <?= ($dados["status"] == 'E' ? 'selected' : '') ?>>Entregue</option>
                        <option value="CC" <?= ($dados["status"] == 'CC' ? 'selected' : '') ?>>Cancelado</option>
                    </select>
                </div>

            <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                    <?php foreach ($dados['listPed'] as $ped) : 
                        $id = $ped->getIdPedido() ?>
                        <div class="col">
                            <div class="card text-center h-100 w-100 mr-2">
                                <div class="card-header">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#name<?= $id ?>" role="tab" data-toggle="tab">Dados do Pedido</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#itens<?= $id ?>" role="tab" data-toggle="tab">Itens</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#status<?= $id ?>" role="tab" data-toggle="tab">Status</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="name<?= $id ?>">
                                            <h5 class="card-title">Dados do pedido: </h5>
                                            <span>Cliente: </span><span><?= $ped->getNomeCliente() ?> </span><br>
                                            <span>Status do Pedido: </span><span><?= $ped->getStatusDesc() ?></span><br>
                                            <span>Valor do Pedido: </span><span>R$<?= $ped->getPrecoPedidoFormatado() ?></span><br>
                                            <span>Status do Pedido: </span><span><?= $ped->getStatusDesc() ?></span>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="status<?= $id ?>">
                                            <span>Status do Pedido: </span><span id="labelStatus<?= $id ?>"><?= $ped->getStatusDesc() ?></span><br>
                                            </br>

                                            <button class="btn btn-success" onclick="changeStatus(<?= $id ?>, 'PP')">
                                            Preparando</button>

                                            <button class="btn btn-success" onclick="changeStatus(<?= $id ?>, 'C')">
                                            Concluido</button>

                                            </br></br>

                                            <button class="btn btn-success" onclick="changeStatus(<?= $id ?>, 'E')">
                                            Entregue</button> 

                                            <button class="btn btn-danger" onclick="changeStatus(<?= $id ?>, 'CC')">
                                            Cancelar</button>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="itens<?= $id ?>">

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
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
        </div>
    </div> <!-- /row -->

    <div class="row">
        <div class="col-6">
            <a class="btn btn-success mt-3" href="homeController.php?action=homeVendedor">Voltar</a>
        </div>
    </div>

    <!--Footer-->
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>

</div>