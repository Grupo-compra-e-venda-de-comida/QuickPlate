<?php
#Inclui o menu da aplicação nas páginas

require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
  $nome = $_SESSION[SESSAO_USUARIO_NOME];

?>

<!-- Navbar -->
<header data-bs-theme="light">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container-fluid">
      <img src="../view/img/logo.png" class="navbar-brand m-1" style="height:20%; width:20%" alt="Logo" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item" style="margin-left: 500px;">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
        </ul>
        <div class="row">
    <div class="col-6" style="margin-top: 10px; margin-right: 100px">
      <a class="btn btn-success" href="pedidoController.php?action=listPedCliente">Pedidos</a>
    </div>
  </div>
        <div class="col-4">
          <ul class="navbar-nav">
            <li class="nav-item active me-auto mb-2 mb-md-0">
              <li class="nav-item active" style="margin-top: 8px;"><?php echo $nome; ?></li>
              <form class="d-flex" role="search">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="loginController.php?action=logout">Sair</a>
                  </li>
                  
                </ul>
              </form>
            </li>
          </ul>
        </div>
      </div>
      <div id="linha-horizontal" style=" position: absolute; width: 100%; border: 1px solid #000; top: 100%; left:0%"></div>
  </nav>
</header>
