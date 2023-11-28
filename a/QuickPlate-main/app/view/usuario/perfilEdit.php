<?php
require_once("../util/config.php");
include_once(__DIR__ . "/../include/header.php")
?>

<link rel="stylesheet" type="text/css" href="../css/autoReg.css">
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<div class="container-fluid pb-5" style="padding-top: 150px; margin-bottom: 75px;">

  <!-- Navbar -->
  <div class="row">
    <?php 
    require_once(__DIR__ . $dados["menu"]);
    ?>
  </div>

  <div class="container-fluid">
    <div class="text-lg-start text-muted">
      <div class="page-title m-4">
        <h2><span>Editar Perfil</span></h2>
      </div>
      <div class="row" style="margin-left: 45.5%; margin-top: 2%">

        <form method="POST" action="<?= BASEURL ?>/controller/usuarioController.php?action=update">

          <div>
            <label class="selectlabel mb-1">Tipo de Usuário</label>
            <select class="select" id="tipo" name="tipo" onchange="mostrar()">
              <option value="C" <?= (isset($dados['usuario']) && $dados['usuario']->getTipo() == 'C' ? 'selected' : ''); ?>>Cliente</option>
              <option value="V" <?= (isset($dados['usuario']) && $dados['usuario']->getTipo() == 'V' ? 'selected' : ''); ?>>Vendedor</option>
            </select>
          </div>


          <div id="divTipoVend" class="form-group" style="display: none;">
            <label class="selectlabel mb-1">Tipo de Vendedor</label>
            <select class="select" id="tipoPessoa" name="tipoPessoa">
              <option value="F" <?= (isset($dados['tipoPessoa']) && $dados['tipoPessoa'] == 'F' ? 'selected' : ''); ?>>Física</option>
              <option value="J" <?= (isset($dados['tipoPessoa']) && $dados['tipoPessoa'] == 'J' ? 'selected' : ''); ?>>Jurídica</option>
            </select>
          </div>

          <div class="form-floating mb-2 ">
            <label for="nome">Nome</label>
            <input type="nome" class="form-control" id="nome" name="nome" value="<?= $dados['usuario']->getNome(); ?>" />
          </div>

          <div class="form-floating mb-2 ">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $dados['usuario']->getEmail(); ?>" />
          </div>

          <div class="form-floating mb-2 ">
            <label for="documento">CPF ou CNPJ</label>
            <input type="text" class="form-control" id="documento" name="documento" readonly value="<?= $dados['documento']; ?>" />
          </div>

          <div class="form-floating">
            <label for="senha">Senha</label>
            <input type="text" class="form-control" id="senha" name="senha" value="<?= $dados['usuario']->getSenha(); ?>" />
          </div>

          <div class="form-floating">
            <label for="senha">Confirmar Senha</label>
            <input type="password" class="form-control" id="confSenha" name="confSenha" />
          </div>

          <button class="w-100 btn btn-lg btn-success mb-2" type="submit">Atualizar</button>
          <a class="w-100 btn btn-lg btn-success" href="homeController.php?action=<?= $dados["home"] ?>">Voltar</a>
          <br><br>

          <?php include(__DIR__ . "/../include/msg.php"); ?>

        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script src="../js/autoReg.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>