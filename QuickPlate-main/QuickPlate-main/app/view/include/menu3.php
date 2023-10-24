<?php
#Inclui o menu da aplicação nas páginas

//Habilitar o recurso de sessão no PHP nesta página
//session_start();  - Comentado, pois este comando já existe no login_verifica.php
//require_once(__DIR__ . "/../../controller/usuarioController.php");

//Variável para validar o acesso
//$acessoCont = new AcessoController();
//$isAdministrador = $acessoCont->tipoUsuario([TipoUsuario::ADMINISTRADOR]);

?>
<link rel="stylesheet" type="text/css" href="../css/estiloMenu3.css">
<!-- Navbar -->
<header data-bs-theme="light">
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <img src="../view/img/logo.png" class="logo m-1" alt="Logo" class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <div class="text" style="position: absolute; top: 40%; bottom: 400px; left: 48%; font-size:25px; font-style:oblique; font-style: bold;">
                        Admin
                    </div>
                </ul>
                <div class="col-4">
                    <ul class="cont navbar-nav">
                        <br>
                        <li class="nav-item active">
                            <a class="nav-link mr-2" href="loginController.php?action=logout">Sair</a>
                        </li>
                    </ul>
                    </form>
                </div>
            </div>
    </nav>
</header>