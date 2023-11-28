<?php
#Objetivo: listar os produtos para o cliente
require_once(__DIR__ . "/../include/header.php");
?>

<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid pb-5" style="margin-top: 150px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
        <?php require_once(__DIR__ . "/../include/menu.php"); ?>
    </div>

    <div class="container-fluid">
        <div class="text-lg-start text-muted">

            <div class="page-title m-4">
                <h2><span>Produtos Disponíveis</span></h2>
                <h2><span><?php  ?></span></h2>
            </div>

            <!-- Criação de Cards de Produtos -->
            <div class="row">

                <!-- PRODUTOS -->
                <div class="col-md-8">

                    <div class="row">
                        <!--  faz a listagem (filtrada pelo id do vendedor) dos produtos -->
                        <?php foreach ($dados["listProd"] as $prod) : ?>

                            <div class="col-md-3 mb-4">

                                <div class="card h-100 w-100" style="background: #f8f9fa;">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $prod->getNomeProduto(); ?></h4>
                                        <p class="card-text"><b>Categoria:</b> <?= $prod->getCategoriaDesc(); ?></p>
                                        <p class="card-text"><b>Descrição: </b> <?= $prod->getDetalhes(); ?></p>
                                        <p class="card-text"><b>Preço:</b> R$ <?= $prod->getPrecoProdutoFormatado(); ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-body-secondary-center"><button class="btn btn-outline-success" onclick="adicionarItem(<?= $prod->getIdProduto() ?>);">Adicionar</button></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Lado Direito da Página -->
                <div class="col-md-4">

                    <div class="row mb-3">
                        <div class="col-6">
                            <label>Total da Compra: R$</label><label id="total"></label>
                        </div>

                        <div class="col d-flex justify-content-end">
                            <a href="../controller/homeController.php?action=homeCliente" class="btn btn-success mr-2 ">Voltar</a>
                            <!-- Botão para acionar o modal -->
                            <button type="button" id="btnFinalizar" class="btn btn-success mr-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" disabled onclick="finalizarPedido(<?= $dados['idVendedor'] ?>);">
                                Finalizar Pedido
                            </button>

                            <!-- Modal 1 -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">PEDIDO CONCLUIDO COM SUCESSO!</h1>
                                        </div>
                                        <div class="modal-body">
                                            Seu pedido foi concluído com sucesso!<br>
                                            Para acompanhá-lo acesse seu <b>histórico de pedidos </b>'<i class="bi bi-bag-check"></i>Pedidos' através do <u>menu</u>.
                                        </div>
                                        <div class="modal-footer">
                                            <a href="../controller/homeController.php?action=homeCliente" class="btn btn-outline-success mr-2 ">Voltar a Tela Inicial</a>
                                            <a href="../controller/pedidoController.php?action=listPedCliente" class="btn btn-outline-success mr-2">Acompanhar Pedido</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARRINHO -->
                    <div class="row">
                        <div class="col">
                            <table id="tabProdCarrinho" class='table table-striped table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th><button class="btn btn-danger" onclick="removerTudo();">Remover Tudo</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-6">
                                    <?php require_once(__DIR__ . "/../include/msg.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.container -->

<script src="<?php echo BASEURL . "/js/pedido.js" ?>"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>