<?php
#Inclui o menu da aplicação nas páginas

//Habilitar o recurso de sessão no PHP nesta página
//session_start();  - Comentado, pois este comando já existe no login_verifica.php

require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");
//require_once(__DIR__ . "/../../controller/usuarioController.php");


$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
  $nome = $_SESSION[SESSAO_USUARIO_NOME];

//Variável para validar o acesso
//$acessoCont = new AcessoController();
//$isAdministrador = $acessoCont->tipoUsuario([TipoUsuario::ADMINISTRADOR]);

?>

<!-- Navbar -->
<header data-bs-theme="light">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">

    <div class="container-fluid">

      <img src="../view/img/logo.png" class="navbar-brand m-1" alt="Logo" style="height:10%; width:9%" href="#"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarCollapse">
        <a class="navbar-brand" href="#"> <a class="nav-link" href="#" style="margin-left: 50%;"><span> <?php echo $nome; ?></span></a>

      </div>


      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="homeController.php?action=homeVendedor"><i class="bi bi-house"></i></i>Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="pedidoController.php?action=listPedVendedor"><i class="bi bi-bag-check"></i>Pedidos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../controller/produtoController.php?action=formProd"><i class="bi bi-bag-plus"></i></i>Adicionar Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../controller/produtoController.php?action=listProdIna"><i class="bi bi-trash3"></i></i>Produtos Inativos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="usuarioController.php?action=pagEdit&id=<?= $_SESSION[SESSAO_USUARIO_ID] ?>"><i class="bi bi-person"></i>Perfil</a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="loginController.php?action=logout"><i class="bi bi-escape"></i>Sair</a>
        </li>
        <span class="border-bottom"></span>
      </ul>
      <header class="text-center fixed-bottom text-lg-start bg-light bb-bold">
  </nav>

</header>