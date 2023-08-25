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
            <table id="tabUsuarios" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Categorias</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //faz a listagem (filtrada pelo id do vendedor) dos produtos
                    foreach ($dados["listProd"] as $prod) :
                    ?>
                        <tr>
                            <td><?= $prod->getIdProduto(); ?></td>
                            <td><?= $prod->getNomeProduto(); ?></td>
                            <td><?= $prod->getPrecoProduto(); ?></td>
                            <td><?= $prod->getCategoriaDesc(); ?></td>
                            <td><?= $prod->getDetalhes(); ?></td>
                            <td><a class="btn btn-primary" href="../controller/pedidoController.php?action=addPed&id=<?= $prod->getIdProduto() ?>">
                                    Adicionar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="../controller/homeController.php?action=homeCliente" class="btn btn-success ">Voltar</a>
        </div>
    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>