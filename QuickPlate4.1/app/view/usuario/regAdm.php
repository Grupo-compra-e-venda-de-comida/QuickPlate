<?php
require_once(__DIR__ . "/../include/header.php");
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
    
      <h1 class="h3">EDIÇÃO DE USUÁRIOS</h1>
    
    <form method="POST" action="usuarioController.php?action=update" >

    <div class="form-floating mb-2 ">
        <input type="id" class="form-control" id="id" name="id" readonly
         value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getIdUsuario() : ''); ?>" />
        <label for="nome">ID</label>
      </div>

      <div class="form-floating mb-2 ">
        <input type="nome" class="form-control" id="nome" name="nome"
         value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getNome() : ''); ?>" />
        <label for="nome">Nome</label>
      </div>

      <div class="form-floating mb-2 ">
        <input type="email" class="form-control" id="email" name="email" 
        value="<?php echo (isset($dados['usuario']) ? $dados['usuario']->getEmail() : ''); ?>" />
        <label for="email">E-mail</label>
      </div>

      <!--
      <div class="form-floating mb-2">
        <input type="password" class="form-control" id="senha" name="senha"
        value="" />
        <label for="senha">Senha</label>
      </div>

      <div class="form-floating mb-2">
        <input type="password" class="form-control" id="confSenha" name="confSenha"
        value="" />
        <label for="senha">Confirmar Senha</label>
      </div>

      <label class="selectlabel mb-2">Tipo de Usuário</label>
      <select class="select" id="tipo" name="tipo">
            <option value="C">Cliente</option>
            <option value="V">Vendedor</option>
      </select>
      -->

      <label class="selectlabel mb-2">Ativo / Inativo</label>
      <select class="select" id="ativo" name="ativo">
            <option value="I">Inativo</option>
            <option value="A">Ativo</option>
      </select>

      <br><br><button class="w-100 btn btn-lg btn-outline-success" type="submit">Registrar</button>

    </form>   

  </main>
</form>

<?php include(__DIR__ . "/../include/msg.php"); ?>
</div>
    
</div>
<?php  
    require_once(__DIR__ . "/../include/footer.php");
?>
</div>


