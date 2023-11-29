<?php
#Inclui o menu da aplicação nas páginas
require_once(__DIR__ . "/../../model/enum/tipoUsuario.php");

$nome = "(Sessão expirada)";

if (isset($_SESSION[SESSAO_USUARIO_NOME])) {
  $nome = $_SESSION[SESSAO_USUARIO_NOME];
}

?>

<header data-bs-theme="light">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">

    <div class="container-fluid">

      <a class="navbar-brand" href="#"><img src="../view/img/logo.png" class="navbar-brand m-1" alt="Logo QuickPlate"></a>

      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarCollapse">

        <a class="nav-link" href="#" style="margin-left: 43%;"><span> <?php echo $nome; ?></span></a>


        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="homeController.php?action=homeCliente"><i class="bi bi-house"></i>Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="pedidoController.php?action=listPedCliente"><i class="bi bi-bag-check"></i>Pedidos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="usuarioController.php?action=pagEdit&id=<?= $_SESSION[SESSAO_USUARIO_ID] ?>"><i class="bi bi-person"></i>Perfil</a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="loginController.php?action=logout"><b><i class="bi bi-escape"></i>Sair</b></a>
          </li>

        </ul>

      </div>
    </div>

  </nav>
</header>