<?php
#Nome do arquivo: home/index.php
#Objetivo: interface com a página inicial do sistema do Administrador

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");
require_once(__DIR__ . "/../include/menu3.php");
?>

<script src="../js/login.js"></script>

<div class="container">
    <div class="container-2" style="position: absolute; bottom: 42%; left: 47%; font-size:25px">
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
