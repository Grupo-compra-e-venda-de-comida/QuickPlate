<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema do Administrador

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");
require_once(__DIR__ . "/../../controller/usuarioController.php")
?>

<script src="../js/login.js"></script>
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<div class="container-fluid pb-5" style="padding-top: 120px; margin-bottom: 75px;">
    <!-- Navbar -->
    <div class="row">
        <?php
        require_once(__DIR__ . "/../include/menu3.php");
        ?>
    </div>

    <div class="container-fluid">

        <!-- Tabela de Usuarios -->
        <div class="text-lg-start text-muted">

            <div class="page-title m-4">
                <h2><span>Tabela de Usuários</span></h2>
            </div>

            <div class="row" style="text-align: center;">
                <table id="tabUsuarios" class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ativo</th>
                            <th>Ativar</th>
                            <th>Inativar</th>
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
                            <td><a class="btn btn-success" onclick="return confirm('Deseja ATIVAR o usuário?');" href="<?= BASEURL ?>/controller/usuarioController.php?action=ativar&id=<?= $usu->getIdUsuario() ?>">
                                    Ativar</a>
                            </td>
                            <td><a class="btn btn-danger" onclick="return confirm('Deseja INATIVAR o usuário?');" href="<?= BASEURL ?>/controller/usuarioController.php?action=inativar&id=<?= $usu->getIdUsuario() ?>">
                                    Inativar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>
</div>