<?php
require_once("../util/config.php");
include_once(__DIR__ . "/../include/header.php")
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../css/autoReg.css">
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<div class="container-fluid pb-5" style="padding-top: 150px; margin-bottom: 75px;">

  <!-- Navbar -->
  <div class="row">
    <?php 
    if ($_SESSION[SESSAO_USUARIO_TIPO] == "C") {
      $menu = "/../include/menu.php";
    } else if ($_SESSION[SESSAO_USUARIO_TIPO] == "V") {
      $menu = "/../include/menu2.php";
    }

    require_once(__DIR__ . $menu);
    ?>
  </div>

  <div class="container-fluid">

    <main class="form-signin" style= "top: 80%; left: 50%;">

      <h1 class="h3" style= "top: 40%; left: 50%; font-size:25px;">Editar Perfil</h1>

        <form method="POST" action="<?= BASEURL ?>/controller/usuarioController.php?action=update">

          <div class="form mb-2 ">
            <label for="nome">Nome:</label>
            <input class="form-control" type="text" id="nome" name="nome" value="<?= $dados['usuario']->getNome(); ?>">
            
          </div>

          <div class="form mb-2 ">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $dados['usuario']->getEmail(); ?>" />
          </div>

          <div class="form mb-2 ">
            <label for="documento">CPF ou CNPJ:</label>
            <input type="text" class="form-control" id="documento" name="documento" readonly value="<?= $dados['documento']; ?>" />
          </div>

          <div class="form mb-2">
            <label for="senha">Senha:</label>
            <input type="text" class="form-control" id="senha" name="senha" value="<?= $dados['usuario']->getSenha(); ?>" />
          </div>

          <div class="form mb-2">
            <label for="senha">Confirmar Senha:</label>
            <input type="password" class="form-control" id="confSenha" name="confSenha" />
          </div>

          <button class="w-100 btn btn-lg btn-success mb-2" type="submit">Atualizar</button>
          <a class="w-100 btn btn-lg btn-success" href="homeController.php?action=<?= $dados["home"] ?>">Voltar</a>
          <br><br>

          <?php include(__DIR__ . "/../include/msg.php"); ?>

        </form> 

    </main>
</div>
</div>

<script src="../js/autoReg.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>