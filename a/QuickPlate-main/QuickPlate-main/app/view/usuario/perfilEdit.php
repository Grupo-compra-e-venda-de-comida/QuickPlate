<?php
require_once("../util/config.php");
?>

<link rel="stylesheet" type="text/css" href="../css/autoReg.css">

<div class="col-4">
  <img src="../view/img/logo.png" class="logo" alt="logo">
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<div class="bg">
  

</div>

<main class="form-signin">
  
  <h1 class="h3" style="color:black">Editar Perfil</h1>
  
  <form method="POST" action="<?= BASEURL ?>/controller/usuarioController.php?action=update">
    
  <div>
    <label class="selectlabel mb-1">Tipo de Usuário</label>
    <input type="text" class="form-control" id="tipoUsuario" name="tipoUsuario" value="<?= $dados['usuario']->getTipoUsuarioDesc(); ?>"/>
  </div>

    <div id="divTipoVend" class="form-group" style="display: none;">
      <label class="selectlabel mb-1">Tipo de Vendedor</label>
      <select class="select" id="tipoPessoa" name="tipoPessoa">
        <option value="F" <?php echo (isset($dados['tipoPessoa']) && $dados['tipoPessoa'] == 'F' ? 'selected' : ''); ?>>Física</option>
        <option value="J" <?php echo (isset($dados['tipoPessoa']) && $dados['tipoPessoa'] == 'J' ? 'selected' : ''); ?>>Jurídica</option>
      </select>
    </div>

  </br>
  
  <div class="form-floating mb-2 ">
    <input type="nome" class="form-control" id="nome" name="nome" value="<?= $dados['usuario']->getNome(); ?>" />
    <label for="nome">Nome</label>
  </div>
  
  <div class="form-floating mb-2 ">
    <input type="email" class="form-control" id="email" name="email" value="<?= $dados['usuario']->getEmail(); ?>" />
    <label for="email">E-mail</label>
  </div>
  
  <div class="form-floating mb-2 ">
    <input type="text" class="form-control" id="documento" name="documento" readonly value="<?= $dados['documento']; ?>" />
    <label for="documento">CPF ou CNPJ</label>
  </div>
  
  <div class="form-floating">
    <input type="text" class="form-control" id="senha" name="senha" value="<?= $dados['usuario']->getSenha(); ?>" />
    <label for="senha">Senha</label>
  </div>
  
  <div class="form-floating">
    <input type="password" class="form-control" id="confSenha" name="confSenha" />
    <label for="senha">Confirmar Senha</label>
  </div>

    <button class="w-100 btn btn-lg btn-outline-success mb-2" type="submit">Atualizar</button>

    <!-- Botão de Voltar -->
    <div class="col-2" style="margin-left: 95%; margin-top: 0.5%">
        <a class="btn btn-success" href="homeController.php?action=<?=$dados["home"]?>">Voltar</a>
    </div>
    
    <br><br>
    
    <?php 
    include(__DIR__ . "/../include/msg.php"); 
    ?>

</form>

</main>


</div>

</div>

</div>

<script src="../js/autoReg.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>