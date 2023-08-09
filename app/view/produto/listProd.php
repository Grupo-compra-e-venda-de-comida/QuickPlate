<?php
#Nome do arquivo: usuario/list.php
#Objetivo: listar os usuarios para o administrador

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");
require_once(__DIR__ . "/../../controller/usuarioController.php");

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
                        <th>Titulo</th>
                        <th>Categorias</th>
                        <th>Detalhes</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($dados['lista'] as $usu): 
                    ?>
                        <tr>
                            <td><?php echo $usu->getIdUsuario(); ?></td>
                            <td><?= $usu->getNome(); ?></td>
                            <td><?= $usu->getEmail(); ?></td>
                            <td><?= $usu->getTipoUsuarioDesc(); ?></td>
                            <td><?= $usu->getAtivoDesc(); ?></td>
                            <td><a class="btn btn-primary" href="<?= BASEURL ?>/controller/usuarioController.php?action=edit&id=<?= $usu->getIdUsuario() ?>">
                                Alterar</a> 
                            </td>
                            <td><a class="btn btn-danger" 
                                onclick="return confirm('Confirma a exclusão do usuário?');"
                                href="<?= BASEURL ?>/controller/usuarioController.php?action=delete&id=<?= $usu->getIdUsuario() ?>">
                                Excluir</a> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <
        </div>
    </div>

</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>