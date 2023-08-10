<?php
    include_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" type="text/css" href="../css/estiloLog.css">
<script src="../js/login.js"></script>

<div class="container">

    <!-- Imagem da Logo -->
    <div class="row">
        <div class="div">
            <img src="../view/img/logo.png" class="logo">
        </div>
    </div>

    <?php require_once(__DIR__ . "/../include/msg.php"); ?>

    <!-- Linha do form -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <!-- <div class="alert alert-info"> -->
            <div class="form">
                <h4>Informe os dados para logar:</h4>
                <br>

                <!-- Formulário de login -->
                    <form id="frmLogin" name="formLogin" >
                    <div class="form-group">
                        <label for="txtEmail">Email:</label>
                        <input type="text"class="form-control" name="email" id="txtEmail"
                            maxlength="50" />        
                    </div>

                    <div class="form-group">
                        <label for="txtSenha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="txtSenha"
                            maxlength="25" />        
                    </div>
                    <div>
                        <button type="button" class="btn btn-success" onclick="logar();">Logar</button>
                        <a href="../controller/usuarioController.php?action=autoReg" class="link">Cadastre-se aqui!</a>
                    </div>
                </form>

            </div>
            
        </div>
    </div>
    <div class="col-12">
        <div id="divMsgErro" class="alert alert-danger" style="display: none;">
            Teste
        </div>
    </div>
</div>

<?php  
    include_once(__DIR__ . "/../include/footer.php");
?>