<?php
include_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" type="text/css" href="../css/estiloLog.css">
<script src="../js/login.js"></script>

<div class="container">

    <!-- Imagem da Logo -->
    <div class="row" style="margin-top: 7%;">
        <div class="div">
            <img src="../view/img/logo.png" class="logo">
        </div>
    </div>

    <!-- Linha do form -->
    <div class="row">
        <div class="col-12">
            <!-- <div class="alert alert-info"> -->
            <div class="form">
                <div class="text-center mb-4">
                    <h4>Informe os dados para entrar:</h4>
                </div>
                <br>
                <!-- Formulário de login -->
                <form id="frmLogin" name="formLogin">
                    <!-- Label do Email -->
                    <div class="form-outline mb-3">
                        <input type="email" class="form-control" name="txtEmail" id="txtEmail" aria-describedby="emailHelp" placeholder="Email:" maxlength="50">
                        <label class="form-label" for="txtEmail"></label>
                    </div>
                    <!-- Label da Senha -->
                    <div class="form-outline">
                        <input type="password" class="form-control" name="txtSenha" id="txtSenha" placeholder="Senha:" maxlength="25" />
                        <label class="form-label" for="txtSenha"></label>
                    </div>
                    <!-- Botões de Logar e Cadastro -->
                    <div>
                        <button type="button" class="btn btn-success" onclick="logar();">Logar</button>
                        <a href="../controller/usuarioController.php?action=autoReg" class="link">Cadastre-se aqui!</a>
                    </div>
                </form>
                <br><br>
                <?php require_once(__DIR__ . "/../include/msg.php"); ?>
            </div>

        </div>
    </div>
    <div class="col-12 mb-5">
        <div id="divMsgErro" class="alert alert-danger" style="display: none;"></div>
    </div>
</div>

<?php
include_once(__DIR__ . "/../include/footer.php");
?>