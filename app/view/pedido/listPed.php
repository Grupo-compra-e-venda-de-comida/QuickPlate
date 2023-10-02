<?php
#Objetivo: listar os produtos para o cliente

require_once(__DIR__ . "/../include/header.php");
?>


<div class="container-fluid pb-5" style="margin-top: 270px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
        <?php require_once(__DIR__ . "/../include/menu.php"); ?>
    </div>

    <div class="row">
        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <!-- Criação de Cards de Pedidos -->
    <div class="row">

        <!-- PEDIDOS -->
        <div class="col-md-8">
            <h1>PEDIDOS PENDENTES</h1>
            <div class="row">
                <!--  faz a listagem dos pedidos -->
                <?php foreach ($dados["listPed"] as $ped) : ?>
                        <div class="card-header">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#name<?=$ped->getIdPedido()?>" role="tab" data-toggle="tab">Nome</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#itens<?=$ped->getIdPedido()?>" role="tab" data-toggle="tab">Itens</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#status<?=$ped->getIdPedido()?>" role="tab" data-toggle="tab">Status</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="name<?=$ped->getIdPedido()?>"> Nome </div>
                                <div role="tabpanel" class="tab-pane" id="itens<?=$ped->getIdPedido()?>"> Itens </div>
                                <div role="tabpanel" class="tab-pane" id="status<?=$ped->getIdPedido()?>"> Status </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>