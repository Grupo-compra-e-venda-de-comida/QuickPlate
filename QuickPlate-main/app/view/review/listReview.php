<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema do Administrador

require_once(__DIR__ . "/../include/header.php");
?>

<script src="../js/review.js"></script>
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">


<div class="container-fluid pb-5" style="padding-top: 120px; margin-bottom: 75px;">
    <!-- Navbar -->
    <div class="row">
        <?php
        require_once(__DIR__ . "/../include/menu.php");
        ?>
    </div>

    <div class="container-fluid">

        <!-- Tabela de Usuarios -->
        <div class="text-lg-start text-muted">

            <div class="page-title m-4">
                <h2><span>Comentários</span></h2>
            </div>
            <div>
                <input type="hidden" >
            </div>


            <div class="row">
                <table id="tabReviews" class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Avaliação</th>
                            <th>Comentário</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //print_r($dados['listRev']);
                    foreach ($dados['listRev'] as $rev) :
                    ?>
                        <tr>
                            <td><?= "nome do cliente" ?></td>
                            <td><?= $rev->getAvaliacao(); ?></td>
                            <td><?= $rev->getComentario(); ?></td>
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