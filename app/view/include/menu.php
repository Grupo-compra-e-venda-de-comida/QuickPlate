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
<!-- Navbar -->
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">

                <!-- Logo -->
                <div class="col-4">
                    <img src="../view/img/logo.png" class="logo m-4" alt="Logo">
                </div>

                <!-- Barra de Navegação com aba 'home', 'categorias' e 'vendedores' -->
                <div class="col-4">
                    <ul class="cont navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home<span class="sr-only">(página atual)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria- expanded="false">
                                Categorias
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#">Vendedores</a>
                        </li>
                    </ul>
                    <br>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Procurar" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <!-- Botões de sacola e bate-papo, com botão de sair do usuario logado -->
                <div class="col-4">
                    <ul class="cont navbar-nav">
                        <li class="nav-item active m-3">
                            <button class="btn btn-success"><i class="bi bi-cart2"></i></button>
                        </li>
                        <li class="nav-item active m-3">
                            <button class="btn btn-success"><i class="bi bi-chat-square-dots"></i></button>
                        </li>

                    </ul>
                    <ul class="cont navbar-nav m-1">
                        <li class="nav-item active">
                            <a class="nav-link ml-3" href="loginController.php?action=logout">Sair</a>
                        </li>
                        <br>
                        <li class="nav-item active ml-3 mt-2"><?php echo $nome; ?></li>
                    </ul>

                </div>
            </div>

        </nav>
    </div>

</div>