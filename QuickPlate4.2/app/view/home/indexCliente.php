<?php 
    require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" type="text/css" href="../css/estiloMenu.css">

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
                Cardápio variado <br>
                atendimento sensacional <br>
                peças novinhas feitas a medida em que acabam 
            </p>
        </div>
        
    </div>
   
<?php  
    require_once(__DIR__ . "/../include/footer.php");
?>