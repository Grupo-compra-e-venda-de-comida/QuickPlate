<?php
#Objetivo: listar os produtos para o cliente

require_once(__DIR__ . "/../include/header.php");
?>

<link href="../css/estiloMenu.css" rel="stylesheet">

<div class="container-fluid pb-5" style="margin-top: 150px; margin-bottom: 75px;">

    <!-- Navbar -->
    <div class="row">
        <?php require_once(__DIR__ . "/../include/menu.php"); ?>
    </div>

    <div class="container-fluid">
        <div class="text-lg-start text-muted">

            <div class="page-title m-4">
                <h2><span>Produtos Disponíveis</span></h2>
            </div>
            
        </div>
    </div>

    <!-- Criação de Cards de Produtos -->
    <div class="row">

        <!-- PRODUTOS -->
        <div class="col-md-8">
            
            <div class="row">
                <!--  faz a listagem (filtrada pelo id do vendedor) dos produtos -->
                <?php foreach ($dados["listProd"] as $prod) : ?>
                    <div class="col-md-2 mb-4">
                        <div class="card h-100 w-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= $prod->getNomeProduto(); ?></h5>
                                <p class="card-text">Categoria: <?= $prod->getCategoriaDesc(); ?></p>
                                <p class="card-text">Descrição: <?= $prod->getDetalhes(); ?></p>
                                <p class="card-text">Preço: R$<?= $prod->getPrecoProduto(); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary-center"><button class="btn btn-success" onclick="adicionarItem(<?= $prod->getIdProduto() ?>);">Adicionar</button></small>
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
                    <button class="btn btn-success mr-2" data-toggle="modal" data-target="#ExemploModalCentralizado" onclick="finalizarPedido(<?= $dados['idVendedor'] ?>);"> Finalizar </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado">PEDIDO CONCLUIDO COM SUCESSO!</h5>
                                    <button type="button" class="close btn-success" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Seu pedido foi concluído com sucesso!
                                </div>
                                <div class="modal-footer">
                                    <a href="../controller/homeController.php?action=homeCliente" class="btn btn-success mr-2 ">Voltar a Tela Inicial</a>
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

</div> <!-- /.container -->

<script src="<?php echo BASEURL . "/js/pedido.js" ?>"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>