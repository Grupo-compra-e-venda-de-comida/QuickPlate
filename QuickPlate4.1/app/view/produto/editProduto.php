<?php
    require_once("../util/config.php");
?>


              <div class="col-4">
                    <img src="../view/img/logo.png" class="logo" alt="logo">
                </div>

                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<div class="bg">


</div>

  <main class="form-signin">
    
      <h1 class="h3">Registrar Produto</h1>
    
    <form method="POST" action="<?= BASEURL ?>/controller/produtoController.php?action=update" >

        <div class="form-floating mb-2 ">
            <input type="id" class="form-control" id="id" name="id" readonly
            value="<?php echo (isset($dados['produto']) ? $dados['produto']->getIdProduto() : ''); ?>" />
            <label for="nome">ID</label>
        </div>

      <div class="form-floating mb-2 ">
        <input type="text" class="form-control" id="nomeProd" name="nomeProd"  />
        <label for="nomeProduto">Titulo do Produto</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="catProd" name="catProd" />
        <label for="catProd">Categoria do Produto</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="detalhes" name="detalhes" />
        <label for="detalhes">Descrição do Produro</label>
      </div>

      <button class="w-100 btn btn-lg btn-outline-success" type="submit">Registrar</button>

    </form>

    <a href="../controller/" class="link">Voltar</a>    

  </main>
</form>

<?php //include(__DIR__ . "/../include/msg.php"); ?>
</div>
    
</div>

</div>

<?php  
    require_once(__DIR__ . "/../include/footer.php");
?>
