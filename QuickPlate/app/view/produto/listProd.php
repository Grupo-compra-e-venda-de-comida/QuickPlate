<?php
#Nome do arquivo: usuario/list.php
#Objetivo: listar os usuarios para o administrador

require_once(__DIR__ . "/../include/header.php");
//require_once(__DIR__ . "/../../model/enum/tipoProduto.php");
require_once(__DIR__ . "/../../controller/produtoController.php");

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
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dados['listProd'] as $prod) :
                    ?>
                        <tr>
                            <td><?php echo $prod->getIdProduto(); ?></td>
                            <td><?= $prod->getNomeProduto(); ?></td>
                            <td><?= $prod->getPrecoProduto(); ?></td>
                            <td><?= $prod->getCategoriaDesc(); ?></td>
                            <td><?= $prod->getDetalhes(); ?></td>
                            <td><a class="btn btn-primary" href="../controller/produtoController.php?action=editProd&id=<?= $prod->getIdProduto() ?>">
                                    Alterar</a>
                            </td>
                            <td><a class="btn btn-danger" onclick="return confirm('Confirma a exclusão do produto?');" href="<?= BASEURL ?>/controller/produtoController.php?action=deleteProd&id=<?= $prod->getIdProduto() ?>">
                                    Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="../controller/homeController.php?action=homeVendedor" class="btn btn-success ">Voltar</a>
        </div>
    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>