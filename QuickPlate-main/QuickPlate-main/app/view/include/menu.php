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
        <div class="text" style="position: absolute; top: 40%; bottom: 400px; left: 48%; font-size:25px; font-style:oblique; font-style: bold;">
                        Cliente
                    </div>
        </ul>
        <div class="col-4">
        <ul class="cont navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link mr-2" href="loginController.php?action=logout">Sair</a>
                        </li>
                        <li class="nav-item active" style="position: absolute; top:25%; left:20%;"><?php echo $nome; ?></li>
                    </ul>
              </form>
            </li>
          </ul>
        </div>
      </div>
      <div id="linha-horizontal" style=" position: absolute; width: 100%; border: 1px solid #000; top: 100%; left:0%"></div>
  </nav>
</header>