<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema do Administrador

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");
require_once(__DIR__ . "/../include/menu3.php");
require_once(__DIR__ . "/../../controller/usuarioController.php")
?>

<script src="../js/login.js"></script>

<div class="container">
    <div class="row mt-5">
        <div>
            <p class="texto"><b>TABELA DO USUÁRIOS</b></p>
        </div>
        <div class="col-12">
            <table id="tabUsuarios" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Ativo</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dados['listaUsuarios'] as $usu) :
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
                            <td><a class="btn btn-danger" onclick="return confirm('Confirma a exclusão do usuário?');" 
                            href="<?= BASEURL ?>/controller/usuarioController.php?action=delete&id=<?= $usu->getIdUsuario() ?>">
                                    Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>