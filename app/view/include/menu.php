<?php
#Inclui o menu da aplicação nas páginas

//Habilitar o recurso de sessão no PHP nesta página
//session_start();  - Comentado, pois este comando já existe no login_verifica.php

require_once(__DIR__ . "/../../controller/acessoController.php");
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");
//require_once(__DIR__ . "/../../controller/usuarioController.php");


$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
  $nome = $_SESSION[SESSAO_USUARIO_NOME];

//Variável para validar o acesso
//$acessoCont = new AcessoController();
//$isAdministrador = $acessoCont->tipoUsuario([TipoUsuario::ADMINISTRADOR]);

?>
<link rel="stylesheet" type="text/css" href="../view/include/menu.css">
<!-- Navbar -->
<header data-bs-theme="light">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container-fluid">
      <img src="../view/img/logo.png" class="logo m-1" alt="Logo" a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Categoria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#">Vendedores</a>
          </li>
        </ul>
        <div class="col-4">
          <ul class="cont navbar-nav">
            <li class="nav-item active me-auto mb-2 mb-md-0">
              <button class="btn btn-success"><i class="bi bi-cart2"></i></button>
              <!--  <li class="nav-item active me-auto mb-2 mb-md-0">
                            <button class="btn btn-success"><i class="bi bi-chat-square-dots"></i></button>
                        </li> -->
              <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <ul class="cont navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="loginController.php?action=logout">Sair</a>
                  </li>
                  <br>
                  <li class="nav-item active"><?php echo $nome; ?></li>
                </ul>
              </form>
        </div>
      </div>
      <div id="linha-horizontal" style=" position: absolute; width: 100%; border: 1px solid #000; top: 100%; left:0%"></div>
  </nav>
</header>