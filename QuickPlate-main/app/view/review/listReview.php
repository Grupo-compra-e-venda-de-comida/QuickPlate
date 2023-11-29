<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <!-- Tabela de Reviews -->
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
                    foreach ($dados['listRev'] as $rev) :
                    ?>
                        <tr>
                                <td><?= $rev->getNomeCliente(); ?></td>
                                <td><?php $nota = $rev->getAvaliacao();
                                    for ($i = 0; $i < $nota; $i++) { ?>
                                        <span class="rating-star">&#9733;</span>
                                    <?php } ?>
                                </td>
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