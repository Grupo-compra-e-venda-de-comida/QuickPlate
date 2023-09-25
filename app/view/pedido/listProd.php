<?php
#Objetivo: listar os produtos para o cliente

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container">

    <div class="row">
        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabProdDisponivel" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categorias</th>
                        <th>Detalhes</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //faz a listagem (filtrada pelo id do vendedor) dos produtos
                    foreach ($dados["listProd"] as $prod) :
                    ?>
                        <tr>
                            <td><?= $prod->getNomeProduto(); ?></td>
                            <td><?= $prod->getCategoriaDesc(); ?></td>
                            <td><?= $prod->getDetalhes(); ?></td>
                            <td><?= $prod->getPrecoProduto(); ?></td>
                            <td><button class="btn btn-primary" onclick="adicionarItem(<?= $prod->getIdProduto() ?>);">
                                    Adicionar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="../controller/homeController.php?action=homeCliente" class="btn btn-success ">Voltar</a>
            <div>
                <label> Total da Compra: </label><label id="total"></label>
            </div>
            <div> 
                <a class="btn btn-warning" onclick="finalizarPedido(<?= $dados['idVendedor'] ?>);"> Finalizar </a> 
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabProdCarrinho" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categorias</th>
                        <th>Detalhes</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="<?php echo BASEURL . "/js/pedido.js" ?>"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>