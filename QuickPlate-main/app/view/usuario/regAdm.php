<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" type="text/css" href="../css/autoReg.css">
<link href="../css/estiloMenu.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">

<div class="container-fluid pb-5" style="padding-top: 120px; margin-bottom: 75px;">

  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu3.php");
    ?>
  </div>

  <div class="container-fluid">

    <div class="text-lg-start text-muted">
      <div class="page-title m-4">
        <h2><span>Edição de Usuários</span></h2>
      </div>
    </div>

    <div class="row" >

      <div class="col-4">
        <img src="../view/img/logo.png" class="logo" alt="logo">
      </div>

      <main class="form-signin">
        <form method="POST" action="usuarioController.php?action=update">

          <div class="form-floating mb-2 ">
            <label for="id"><span>ID do usuário</span></label>
            <input type="id" class="form-control" id="id" name="id" readonly value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getIdUsuario() : ''); ?>" />
          </div>

          <div class="form-floating mb-2 ">
            <label for="nome">Nome do usuário</label>
            <input type="nome" class="form-control" id="nome" name="nome" value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getNome() : ''); ?>" />
          </div>

          <div class="form-floating mb-2 ">
            <label for="email">E-mail do usuário</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getEmail() : ''); ?>" />         
          </div>

          <label class="selectlabel mb-2">Ativo / Inativo</label>
          <select class="select" id="ativo" name="ativo">
            <option value="I" <?php echo (isset($dados['usuario']) && $dados['usuario']->getAtivo() == 'I' ? 'selected' : ''); ?>>Inativo</option>
            <option value="A" <?php echo (isset($dados['usuario']) && $dados['usuario']->getAtivo() == 'A' ? 'selected' : ''); ?>>Ativo</option>
          </select>

          <input class="w-100 btn btn-primary btn-lg btn-success mt-3" type="submit" value="Alterar">

        </form>

        <?php include(__DIR__ . "/../include/msg.php"); ?>

      </main>
    </div>
  </div>

  <?php require_once(__DIR__ . "/../include/footer.php"); ?>
  
</div>