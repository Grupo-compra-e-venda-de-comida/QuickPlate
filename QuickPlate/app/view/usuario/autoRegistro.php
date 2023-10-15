<?php
require_once("../util/config.php");
?>


<link rel="stylesheet" type="text/css" href="../css/autoReg.css">

<div class="col-4">
  <img src="../view/img/logo.png" class="logo" alt="logo">
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="../js/autoReg.js"></script>
<div class="bg">


</div>

<main class="form-signin">

  <h1 class="h3">Registre-se aqui</h1>

  <form method="POST" action="<?= BASEURL ?>/controller/usuarioController.php?action=save">

  <div>
      <label class="selectlabel mb-1">Tipo de Usuário</label>
      <select class="select" id="tipo" name="tipo" onchange="mostrar()">
        <option value="C">Cliente</option>
        <option value="V">Vendedor</option>
      </select>
    </div>

    <div id="divTipoVend" class="form-group" style="display: none;">
      <label class="selectlabel mb-1">Tipo de Vendedor</label>
      <select class="select" id="tipoPessoa" name="tipoPessoa">
        <option value="F">Física</option>
        <option value="J">Jurídica</option>
      </select>
    </div>

</br>

    <div class="form-floating mb-2 ">
      <input type="nome" class="form-control" id="nome" name="nome" value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getNome() : ''); ?>" />
      <label for="nome">Nome</label>
    </div>

    <div class="form-floating mb-2 ">
      <input type="email" class="form-control" id="email" name="email" value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getEmail() : ''); ?>" />
      <label for="email">E-mail</label>
    </div>

    <div class="form-floating mb-2 ">
      <input type="text" class="form-control" id="documento" name="documento" />
      <label for="documento">CPF ou CNPJ</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="senha" name="senha" />
      <label for="senha">Senha</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="confSenha" name="confSenha" />
      <label for="senha">Confirmar Senha</label>
    </div>

    <div class="checkbox mb-3">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" value="1" name="remember_me" id="rememberMeSwitch">
        <label class="form-check-label" for="rememberMeSwitch">Lembrar-se</label>
      </div>

    </div>

    <button class="w-100 btn btn-lg btn-outline-success mb-2" type="submit">Registrar</button>

    <a href="../controller/loginController.php?action=login" class="link">Já possui uma conta? <b>LOGIN</b></a>

    <br><br>

    <?php 
    include(__DIR__ . "/../include/msg.php"); 
    ?>

  </form>

</main>


</div>

</div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>