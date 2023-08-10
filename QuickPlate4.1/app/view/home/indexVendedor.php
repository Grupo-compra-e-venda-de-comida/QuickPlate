<?php 
    require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" type="text/css" href="../css/estiloVendedor.css">

<div class="topnav">

<img src="img/logo.png" class="logo" alt="logo" href="#logo">
     
  <img src="img/chat.png" class="chat" alt="chat" href="#chat">
  <a class="dashboard" href="#dashboard">Dashboard</a>
  <a class="nome" href="#nome">Nome<br>Usuário</a>
  <a href="../controller/loginController.php?action=logout" class="sair"> Sair </a>

</div>

<a href="../controller/produtoController.php?action=formProd" class="myButton">Cadastre Produto</a></br>
<a href="../controller/produtoController.php?action=listProd" class="myButtona">Seus Produtos</a></br>

<?php  
    require_once(__DIR__ . "/../include/footer.php");
?>