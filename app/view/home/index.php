<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema do Administrador

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");

?>

<script src="../js/login.js"></script>

<div class="container">

    <!-- Navbar -->
    <div class="row">
        <?php 
            require_once(__DIR__ . "/../include/menu.php"); 
        ?>
    </div>

    <!-- Texto com botão de iniciar pedido -->
    <div class="container-2" style="position: absolute; bottom: 200px; left: 125px; font-size:25px">
        <div class="row">
            <p>
                <button type="button" class="btn btn-success" onclick="list()">Usuarios</button>
            </p>
        </div>
        
    </div>
    
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
